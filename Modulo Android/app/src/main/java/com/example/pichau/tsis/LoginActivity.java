package com.example.pichau.tsis;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.dd.CircularProgressButton;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

public class LoginActivity extends AppCompatActivity implements ConnectivityReceiver.ConnectivityReceiverListener {

    EditText txtEmail;
    EditText txtSenha;
    ProgressDialog pdg;
    CircularProgressButton BtnLogar;
    String message;
    boolean con;
    TextView txvCon2;
    CircularProgressButton btnCadastro;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        ShowIndex2();



         txvCon2 = (TextView)findViewById(R.id.text2);
        txvCon2.setText("Aguarde");
         btnCadastro = (CircularProgressButton) findViewById(R.id.btnLogin);
        btnCadastro.setText("Cadastrar");
        btnCadastro.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(),CadastroActivity.class));


            }
        });


        TextView btnRecovery = (TextView) findViewById(R.id.btnRecovery);
        btnRecovery.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(),RecoveryActivity.class));
            }
        });


         BtnLogar = (CircularProgressButton) findViewById(R.id.btnCadastrar);
        BtnLogar.setText("Logar");
        checkConnection();

        BtnLogar.setOnClickListener(new View.OnClickListener()  {
            @Override
            public void onClick(View v) {

                if(con) {

                    EditText txtLoginEmail = (EditText) findViewById(R.id.txtEmailLogin);
                    EditText txtLoginSenha = (EditText) findViewById(R.id.txtSenhaLogin);
                    pdg = new ProgressDialog(LoginActivity.this);
                    pdg.setTitle("Aguarde...");
                    pdg.setMessage("Entrando no sistema..");
                    pdg.setCancelable(false);
                    int error = 0;

                    if (txtLoginEmail.getText().toString().equals("")) {
                        txtLoginEmail.setError("Preencha o campo e-mail.");
                        txtLoginEmail.requestFocus();
                        error = 1;
                        pdg.dismiss();
                    } else if (txtLoginSenha.getText().toString().equals("")) {
                        txtLoginSenha.setError("Preencha o campo senha.");
                        txtLoginSenha.requestFocus();
                        error = 1;
                        pdg.dismiss();
                    }

                    if (error == 0) {
                        pdg.show();
                        String URL = "http://tcc2017.com.br/renato/tsis/usuario/autenticarAndroid";

                        SharedPreferences preferences = getBaseContext().getSharedPreferences("USER_INFORMATION", Context.MODE_PRIVATE);


                        Ion.with(getBaseContext())
                                .load(URL)
                                .setBodyParameter("email", txtLoginEmail.getText().toString())
                                .setBodyParameter("senha", txtLoginSenha.getText().toString())
                                .asJsonObject()
                                .setCallback(new FutureCallback<JsonObject>() {
                                    @Override
                                    public void onCompleted(Exception e, JsonObject result) {
                                        if (result.get("retorno").getAsInt() > 0) {
                                            Toast.makeText(getBaseContext(), result.get("nome").getAsString(), Toast.LENGTH_LONG).show();

                                            SharedPreferences.Editor preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE).edit();
                                            preferences.putInt("idPessoa", result.get("retorno").getAsInt());
                                            preferences.putString("email_usuario", result.get("email").getAsString());
                                            preferences.putString("senha_usuario", result.get("senha").getAsString());
                                            preferences.putString("nome_usuario", result.get("nome").getAsString());
                                            preferences.putString("sexo_usuario", result.get("sexo").getAsString());
                                            preferences.putString("secao_usuario", result.get("nomeSecao").getAsString());
                                            preferences.putInt("idUsuario", result.get("id_usuario").getAsInt());
                                            preferences.putInt("secaoId", result.get("secaoId").getAsInt());
                                            preferences.commit();
                                            ShowIndex();


                                        } else {
                                            pdg.dismiss();
                                            Toast.makeText(getBaseContext(), "Login ou senha invalidos.", Toast.LENGTH_LONG).show();
                                        }
                                    }
                                });
                    }


                }else{
                    mostraAlerta();
                }
            }
        });

    }


    private void checkConnection() {
        boolean isConnected = ConnectivityReceiver.isConnected();
        showSnack(isConnected);
    }

    private void showSnack(boolean isConnected) {


        if (isConnected) {
            txvCon2.setText("Disponivel");
            con = true;
            BtnLogar.setEnabled(true);
            btnCadastro.setEnabled(true);


        } else {
            txvCon2.setText("Sem conexão");
            con = false;
            BtnLogar.setEnabled(false);
            btnCadastro.setEnabled(false);
        }



    }


    @Override
    protected void onResume() {
        super.onResume();

        // register connection status listener
        MyApplication.getInstance().setConnectivityListener(this);
    }

    @Override
    public void onNetworkConnectionChanged(boolean isConnected) {
        showSnack(isConnected);
    }



    private void ShowIndex(){
        SharedPreferences preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE);

        if (preferences.getInt("idPessoa", 0) > 0) {
            Intent it = new Intent(LoginActivity.this, IndexActivity.class);
            startActivity(it);
            finish();
        }

    }


    public void ShowIndex2(){
        SharedPreferences preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE);

        if (preferences.getInt("idPessoa", 0) > 0) {
            Intent it = new Intent(LoginActivity.this, IndexActivity.class);
            startActivity(it);
            finish();
        }

    }

    private void mostraAlerta() {
        Toast.makeText(getBaseContext(), "Verifique sua conexão com a internet!", Toast.LENGTH_SHORT).show();
    }

    public void onBackPressed()  {

// Implemente aqui o novo comportamento do botao back

// ou deixe em branco para desabilitar qualquer acao do botao

    }



}