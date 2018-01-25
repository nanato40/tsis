package com.example.pichau.tsis;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import com.dd.CircularProgressButton;
import com.example.pichau.tsis.Models.Secao;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;

public class PerfilActivity extends AppCompatActivity implements ConnectivityReceiver.ConnectivityReceiverListener {

    EditText txtNomePerfil;
    Spinner spinnerSexo;
    EditText txtEmailPerfil;
    EditText txtConfirmaEmailPerfil;
    EditText txtSenhaPerfil;
    EditText txtConfirmaSenhaPerfil;
    Spinner spinnerSecao;
    CircularProgressButton btnAtualizarPerfil;
    ProgressDialog pdg;
    String idPessoa,idUsuario;
    ArrayList<String> secao;
    ArrayList<Secao> secList;
    String idSecao;
    ArrayAdapter<String> dataAdapterSecao;
    ProgressDialog load;
    SharedPreferences preferences;
    boolean con;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";
    SharedPreferences settings;
    private static final String[] sexo = { "Masculino",
            "Feminino"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_perfil);

        new Load().execute();
        txtNomePerfil = (EditText) findViewById(R.id.txtNomePerfil);
       spinnerSexo = (Spinner) findViewById(R.id.spinnerSexo);
        txtEmailPerfil = (EditText) findViewById(R.id.txtEmailPerfil);
        txtConfirmaEmailPerfil = (EditText) findViewById(R.id.txtConfirmaEmailPerfil);
        txtSenhaPerfil = (EditText) findViewById(R.id.txtSenhaPerfil);
        txtConfirmaSenhaPerfil = (EditText) findViewById(R.id.txtConfirmaSenhaPerfil);
        spinnerSecao = (Spinner) findViewById(R.id.spinnerSecaoPerfil);
        btnAtualizarPerfil = (CircularProgressButton) findViewById(R.id.btnAtualizarPerfil);


        secList = new ArrayList<Secao>();
        secao = new ArrayList<String>();

        checkConnection();

        dataAdapterSecao = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, secao);
        spinnerSecao.setAdapter(dataAdapterSecao);
        spinnerSecao.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

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

        spinnerSexo.setAdapter(new ArrayAdapter<String>(getBaseContext(),android.R.layout.simple_spinner_dropdown_item,sexo));
        preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE);

        txtNomePerfil.setText(preferences.getString("nome_usuario","SD"));
        txtEmailPerfil.setText(preferences.getString("email_usuario", "SD3"));
        txtSenhaPerfil.setText(preferences.getString("senha_usuario", "SD4"));



        CircularProgressButton btnVoltaPerfil = (CircularProgressButton) findViewById(R.id.btnVoltaPerfil);
        btnVoltaPerfil.setText("Voltar");
        btnVoltaPerfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(),IndexActivity.class));
            }
        });

        btnAtualizarPerfil.setText("Atualizar");
        btnAtualizarPerfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                pdg = new ProgressDialog(PerfilActivity.this);
                pdg.setTitle("Aguarde...");
                pdg.setMessage("Realizando ação..");
                pdg.setCancelable(false);

                int error = 0;
                int emailError = 0;
                int emailError2= 0;
                int emailError3= 0;

                if (txtNomePerfil.getText().toString().equals("")){
                    txtNomePerfil.setError("Preencha o campo nome.");
                    txtNomePerfil.requestFocus();
                    error = 1;
                    pdg.dismiss();
                }  else if (txtEmailPerfil.getText().toString().equals("")){
                    txtEmailPerfil.setError("Preencha o campo Email.");
                    txtEmailPerfil.requestFocus();
                    error = 1;

                    pdg.dismiss();
                }else if (txtSenhaPerfil.getText().toString().equals("")){
                    txtSenhaPerfil.setError("Preencha o campo Senha.");
                    txtSenhaPerfil.requestFocus();
                    error = 1;
                    pdg.dismiss();
                }
                else if (txtConfirmaEmailPerfil.getText().toString().equals("")){
                    txtConfirmaEmailPerfil.setError("Preencha o campo confirma e-mail.");
                    txtConfirmaEmailPerfil.requestFocus();
                    error = 1;

                    pdg.dismiss();


                }

                else if (txtConfirmaSenhaPerfil.getText().toString().equals("")){
                    txtConfirmaSenhaPerfil.setError("Preencha o campo de confirmação de senha.");
                    txtConfirmaSenhaPerfil.requestFocus();
                    error = 1;
                    pdg.dismiss();
                }
                else if (txtSenhaPerfil.getText().toString().equals(txtConfirmaSenhaPerfil.getText().toString())){
                    emailError2 = 1;

                }else{
                    txtConfirmaSenhaPerfil.setError("Senhas não conferem !");
                    txtConfirmaSenhaPerfil.requestFocus();
                    pdg.dismiss();
                    error = 1;
                }

                if(emailError == 0){

                    if(txtEmailPerfil.getText().toString().equals(txtConfirmaEmailPerfil.getText().toString())){
                        emailError3 = 1;
                    }
                    else{
                        txtConfirmaEmailPerfil.setError("E-mails não conferem !");
                        txtConfirmaEmailPerfil.requestFocus();
                        pdg.dismiss();
                        error = 1;
                    }}

                if(con){

                if (error == 0 && emailError2 == 1 && emailError3 == 1) {
                    SharedPreferences.Editor preferences2 = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE).edit();
                    preferences2.remove("nome_usuario").commit();
                    preferences2.putString("nome_usuario", txtNomePerfil.getText().toString());
                    preferences2.putString("email_usuario", txtEmailPerfil.getText().toString());
                    preferences2.commit();


                    idPessoa = Integer.toString(preferences.getInt("idPessoa",0));
                    idUsuario = Integer.toString(preferences.getInt("idUsuario",0));
                    Ion.with(getBaseContext())
                            .load("usuario/updateUserAndroid")
                            .setBodyParameter("idPessoa", idPessoa)
                            .setBodyParameter("idUsuario", idUsuario)
                            .setBodyParameter("nome", txtNomePerfil.getText().toString())
                            .setBodyParameter("sexo", spinnerSexo.getSelectedItem().toString())
                            .setBodyParameter("email", txtEmailPerfil.getText().toString())
                            .setBodyParameter("senha", txtSenhaPerfil.getText().toString())
                            .setBodyParameter("secao", idSecao)
                            .asJsonObject()
                            .setCallback(new FutureCallback<JsonObject>() {
                                @Override
                                public void onCompleted(Exception e, JsonObject result) {
                                    if (result.get("retorno").getAsString().equals("YES")) {

                                        pdg.dismiss();
                                        Toast.makeText(getBaseContext(), "Usuário atualizado com sucesso", Toast.LENGTH_SHORT).show();
                                        startActivity(new Intent(getBaseContext(), IndexActivity.class));

                                        finish();
                                    } else {
                                        Toast.makeText(getBaseContext(), "Por favor, tente novamente mais tarde !", Toast.LENGTH_SHORT).show();
                                        startActivity(new Intent(getBaseContext(), IndexActivity.class));
                                        pdg.dismiss();
                                        finish();
                                    }
                                }
                            });
                }}

            }
        });



    }

    private void checkConnection() {
        boolean isConnected = ConnectivityReceiver.isConnected();
        showSnack(isConnected);
    }

    private void showSnack(boolean isConnected) {


        if (isConnected) {
            con = true;
        } else {

            settings = getBaseContext().getSharedPreferences("USER_INFORMATION", Context.MODE_PRIVATE);
            AlertDialog.Builder alerta = new AlertDialog.Builder(this);
            alerta.setCancelable(false);
            alerta.setTitle("Aviso !");
            alerta .setMessage("Sem conexão com o servidor !");
            alerta .setPositiveButton("Voltar",
                    new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            settings.edit().clear().commit();
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

            load = new ProgressDialog(PerfilActivity.this);
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
