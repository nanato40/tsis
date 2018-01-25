package com.example.pichau.tsis;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.io.File;

public class IndexActivity extends AppCompatActivity implements ConnectivityReceiver.ConnectivityReceiverListener {

    ImageButton btnDownload,btnPerfil,btnVerEnvio,btnSair,btnEnviar;
    String idUsuario;
    ProgressDialog pdg;
    SharedPreferences settings;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_index);

        btnSair = (ImageButton) findViewById(R.id.btnSair);
        btnSair.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                pdg = new ProgressDialog(IndexActivity.this);
                pdg.setTitle("Aguarde...");
                pdg.setMessage("Saindo..");
                pdg.setCancelable(false);
                pdg.show();

               settings = getBaseContext().getSharedPreferences("USER_INFORMATION", Context.MODE_PRIVATE);
                idUsuario = Integer.toString(settings.getInt("idUsuario",0));
                Ion.with(getBaseContext())
                        .load(URL+"usuario/deleteToken")
                        .setBodyParameter("idUsuario",idUsuario )
                        .asJsonObject()
                        .setCallback(new FutureCallback<JsonObject>() {
                            @Override
                            public void onCompleted(Exception e, JsonObject result) {
                                if (result.get("retorno").getAsString().equals("YES")) {
                                    Toast.makeText(getBaseContext(), "Logout realizado com sucesso!", Toast.LENGTH_LONG).show();
                                    settings.edit().clear().commit();
                                    startActivity(new Intent(getBaseContext(),LoginActivity.class));

                                } else  {
                                    pdg.dismiss();
                                    Toast.makeText(getBaseContext(), "Tente novamente !", Toast.LENGTH_LONG).show();
                                    startActivity(new Intent(getBaseContext(),IndexActivity.class));


                                }
                            }
                        });

            }
        });

        btnDownload = (ImageButton) findViewById(R.id.btnDownload);
        btnDownload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(),DownloadActivity.class));
            }
        });

        btnVerEnvio = (ImageButton) findViewById(R.id.btnVerEnvios);
        btnVerEnvio.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(), ListarContratoActivity.class));
            }
        });

        btnEnviar = (ImageButton) findViewById(R.id.btnEnviar);
        btnEnviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(), EnviarContratoActivity.class));
            }
        });

        btnPerfil = (ImageButton) findViewById(R.id.btnPerfil);
        btnPerfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(getBaseContext(), PerfilActivity.class));
            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();

        // register connection status listener
        MyApplication.getInstance().setConnectivityListener(this);
    }


    private void Conexao(){
        settings = getBaseContext().getSharedPreferences("USER_INFORMATION", Context.MODE_PRIVATE);



        AlertDialog.Builder alerta =  new AlertDialog.Builder(this);
               alerta .setCancelable(false);
               alerta .setTitle("Aviso !");
               alerta .setMessage("Sem conexão com o servidor !")
                .setPositiveButton("Voltar",
                        new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                settings.edit().clear().commit();
                                startActivity(new Intent(getBaseContext(),LoginActivity.class));
                                finish();
                            }
                        })
                .show();

    }


    @Override
    public void onNetworkConnectionChanged(boolean isConnected) {
        showSnack(isConnected);
    }

    private void showSnack(boolean isConnected) {


        if (isConnected) {

        } else {
            Conexao();
        }

        finish();



    }


}
