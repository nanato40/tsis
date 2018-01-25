package com.example.pichau.tsis;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.dd.CircularProgressButton;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

public class RecoveryActivity extends AppCompatActivity {

    CircularProgressButton btnRecoveryPass;
    ProgressDialog pdg;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recovery);


        btnRecoveryPass = (CircularProgressButton)findViewById(R.id.btnRecoveryPass);
        btnRecoveryPass.setText("Recuperar");
        btnRecoveryPass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

        if(temConexao(getBaseContext())) {

            EditText txtRecovery = (EditText) findViewById(R.id.txtRecovery);
            pdg = new ProgressDialog(RecoveryActivity.this);
            pdg.setTitle("Aguarde...");
            pdg.setMessage("Enviando..");
            pdg.setCancelable(false);
            int error = 0;

            if (txtRecovery.getText().toString().equals("")) {
                txtRecovery.setError("Preencha o campo e-mail.");
                txtRecovery.requestFocus();
                error = 1;
                pdg.dismiss();
            }

            if (error == 0) {

                Ion.with(getBaseContext())
                        .load("http://tcc2017.com.br/renato/tsis/usuario/verificarEmailAndroid")
                        .setBodyParameter("txtEmail", txtRecovery.getText().toString())
                        .asJsonObject()
                        .setCallback(new FutureCallback<JsonObject>() {
                            @Override
                            public void onCompleted(Exception e, JsonObject result) {
                                if (result.get("retorno").getAsString().equals("YES")) {
                                    Toast.makeText(getBaseContext(), "Verifique seu e-mail!", Toast.LENGTH_LONG).show();
                                } else {
                                    pdg.dismiss();
                                    Toast.makeText(getBaseContext(), "E-mail não existe !", Toast.LENGTH_LONG).show();
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


    private boolean temConexao(Context classe) {
        //Pego a conectividade do contexto passado como argumento
        ConnectivityManager gerenciador = (ConnectivityManager) classe.getSystemService(Context.CONNECTIVITY_SERVICE);
        //Crio a variável informacao que recebe as informações da Rede
        NetworkInfo informacao = gerenciador.getActiveNetworkInfo();
        //Se o objeto for nulo ou nao tem conectividade retorna false
        if ((informacao != null) && (informacao.isConnectedOrConnecting()) && (informacao.isAvailable())) {
            return true;
        }
        return false;
    }


    private void mostraAlerta() {
        Toast.makeText(getBaseContext(), "Verifique sua conexão com a internet", Toast.LENGTH_SHORT).show();
    }
}
