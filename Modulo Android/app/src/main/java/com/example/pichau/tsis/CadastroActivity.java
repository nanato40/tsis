package com.example.pichau.tsis;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.dd.CircularProgressButton;
import com.example.pichau.tsis.Models.Secao;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;

public class CadastroActivity extends AppCompatActivity implements ConnectivityReceiver.ConnectivityReceiverListener {



    EditText txtNome;
    EditText txtEmail;
    EditText txtConfirmaEmail;
    Spinner spSexo;
    EditText txtSenha;
    EditText txtConfirmaSenha;
    Spinner txtSecao;
    ProgressDialog pdg;
    ArrayList<String> secao;
    ArrayList<Secao> secList;
    ArrayAdapter<String> dataAdapterSecao,spSexoAd;
    ProgressDialog load;
    TextView txvId;
    boolean con;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";
    private static final String[] sexo = { "Masculino",
            "Feminino"};

    String idSecao;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cadastro);

        new Load().execute();
        spSexo =  (Spinner)findViewById(R.id.spinnerSexo);
        secList = new ArrayList<Secao>();
        secao = new ArrayList<String>();
        txtSecao =  (Spinner)findViewById(R.id.spinnerSecao);
        dataAdapterSecao = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, secao);
        spSexoAd = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, sexo);
        txtSecao.setAdapter(dataAdapterSecao);
        spSexo.setAdapter(spSexoAd);



        CircularProgressButton btnVoltar = (CircularProgressButton)findViewById(R.id.btnLogin);
        btnVoltar.setText("Voltar");
        btnVoltar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(),LoginActivity.class));
            }
        });

        checkConnection();




        txtSecao.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> arg0,
                                       View arg1, int position, long arg3) {
                // TODO Auto-generated method stub

                idSecao = secList.get(position).getId();


            }

            @Override
            public void onNothingSelected(AdapterView<?> arg0) {
                // TODO Auto-generated method stub
            }
        });


        CircularProgressButton btnCad = (CircularProgressButton) findViewById(R.id.btnCadastrar);
        btnCad.setText("Cadastrar");
        btnCad.setOnClickListener(new View.OnClickListener() {
                                      @Override
                                      public void onClick(View v) {


                                          txtNome = (EditText)findViewById(R.id.txtNome);

                                          txtEmail =  (EditText)findViewById(R.id.txtEmail);
                                          txtConfirmaEmail = (EditText)findViewById(R.id.txtConfirmaEmail);
                                          txtSenha =  (EditText)findViewById(R.id.txtSenha);
                                          txtConfirmaSenha =  (EditText)findViewById(R.id.txtConfirmaSenha);

                                          pdg = new ProgressDialog(CadastroActivity.this);
                                          pdg.setTitle("Aguarde...");
                                          pdg.setMessage("Realizando ação..");
                                          pdg.setCancelable(false);

                                          int error = 0;
                                          int emailError = 0;
                                          int emailError2= 0;
                                          int emailError3= 0;

                                          if (txtNome.getText().toString().equals("")){
                                              txtNome.setError("Preencha o campo nome.");
                                              txtNome.requestFocus();
                                              error = 1;
                                              pdg.dismiss();
                                          }  else if (txtEmail.getText().toString().equals("")){
                                              txtEmail.setError("Preencha o campo Email.");
                                              txtEmail.requestFocus();
                                              error = 1;

                                              pdg.dismiss();
                                          }else if (txtSenha.getText().toString().equals("")){
                                              txtSenha.setError("Preencha o campo Senha.");
                                              txtSenha.requestFocus();
                                              error = 1;
                                              pdg.dismiss();
                                          }
                                          else if (txtConfirmaEmail.getText().toString().equals("")){
                                              txtConfirmaEmail.setError("Preencha o campo confirma e-mail.");
                                              txtConfirmaEmail.requestFocus();
                                              error = 1;

                                              pdg.dismiss();


                                          }

                                          else if (txtConfirmaSenha.getText().toString().equals("")){
                                              txtConfirmaSenha.setError("Preencha o campo de confirmação de senha.");
                                              txtConfirmaSenha.requestFocus();
                                              error = 1;
                                              pdg.dismiss();
                                          }
                                          else if (txtSenha.getText().toString().equals(txtConfirmaSenha.getText().toString())){
                                              emailError2 = 1;

                                          }else{
                                              txtConfirmaSenha.setError("Senhas não conferem !");
                                              txtConfirmaSenha.requestFocus();
                                              pdg.dismiss();
                                              error = 1;
                                          }

                                          if(emailError == 0){

                                              if(txtEmail.getText().toString().equals(txtConfirmaEmail.getText().toString())){
                                                  emailError3 = 1;
                                              }
                                              else{
                                                  txtConfirmaEmail.setError("E-mails não conferem !");
                                                  txtConfirmaEmail.requestFocus();
                                                  pdg.dismiss();
                                                  error = 1;
                                              }}

                                          if(con){

                                              if (error == 0 && emailError2 == 1 && emailError3 == 1) {
                                              pdg = new ProgressDialog(CadastroActivity.this);
                                              pdg.setTitle("Aguarde...");
                                              pdg.setMessage("Cadastrando usuário..");
                                              pdg.setCancelable(false);
                                              pdg.show();
                                              Ion.with(getBaseContext())
                                                      .load(URL+"usuario/salvarUsuario")
                                                      .setBodyParameter("nome", txtNome.getText().toString())
                                                      .setBodyParameter("sexo", spSexo.getSelectedItem().toString())
                                                      .setBodyParameter("email", txtEmail.getText().toString())
                                                      .setBodyParameter("senha", txtSenha.getText().toString())
                                                      .setBodyParameter("secao", idSecao)
                                                      .asJsonObject()
                                                      .setCallback(new FutureCallback<JsonObject>() {
                                                          @Override
                                                          public void onCompleted(Exception e, JsonObject result) {
                                                              if (result.get("retorno").getAsString().equals("YES")) {
                                                                  pdg.dismiss();
                                                                  Toast.makeText(getBaseContext(), "Usuário cadastrado com sucesso", Toast.LENGTH_SHORT).show();
                                                                  startActivity(new Intent(getBaseContext(), LoginActivity.class));
                                                                  finish();
                                                              }

                                                              else if(result.get("retorno").getAsString().equals("NO")){
                                                                  Toast.makeText(getBaseContext(), "Por favor, tente novamente mais tarde !", Toast.LENGTH_SHORT).show();
                                                                  pdg.dismiss();
                                                                  finish();
                                                              }else if(result.get("retorno").getAsString().equals("ERROR_EMAIL")){
                                                                  pdg.dismiss();
                                                                  Toast.makeText(getBaseContext(), "E-mail já existe !", Toast.LENGTH_SHORT).show();
                                                              }
                                                          }
                                                      });


                                          }}



                                      }
                                  }
        );

    }

    private void checkConnection() {
        boolean isConnected = ConnectivityReceiver.isConnected();
        showSnack(isConnected);
    }

    private void showSnack(boolean isConnected) {


        if (isConnected) {
            con = true;
        } else {
            AlertDialog.Builder alerta = new AlertDialog.Builder(this);
                    alerta.setCancelable(false);
                    alerta.setTitle("Aviso !");
            alerta .setMessage("Sem conexão com o servidor !");
            alerta .setPositiveButton("Voltar",
                            new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialogInterface, int i) {

                                    startActivity(new Intent(getBaseContext(),LoginActivity.class));
                                }
                            })
                    .show();
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

    private class Load extends AsyncTask<Void, Void, Void>{



        @Override
        protected Void doInBackground(Void... params) {


            Ion.with(getBaseContext())
                    .load(URL+"secao/listarSecaoMobile")
                    .asJsonArray()
                    .setCallback(new FutureCallback<JsonArray>() {
                        @Override
                        public void onCompleted(Exception e, JsonArray result) {

                            for(int i = 0; i < result.size(); i++){
                                JsonObject retorno = result.get(i).getAsJsonObject();

                                Secao sec = new Secao();

                                sec.setId(retorno.get("id_secao").getAsString());
                                sec.setNomeSecao(retorno.get("nomeSecao").getAsString());
                                secList.add(sec);

                                //Popula spinner
                                secao.add(retorno.get("nomeSecao").getAsString());

                                dataAdapterSecao.setNotifyOnChange(true);
                                dataAdapterSecao.notifyDataSetChanged();

                            }


                        }
                    });


            return null;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            load = new ProgressDialog(CadastroActivity.this);
            load.setMessage("Aguarde..");
            load.setCancelable(false);
            load.show();

        }



        @Override
        protected void onPostExecute(Void args) {
            load.dismiss();
        }
    }


}

