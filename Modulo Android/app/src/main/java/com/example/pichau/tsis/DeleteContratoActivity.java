package com.example.pichau.tsis;

import android.app.DownloadManager;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.io.File;

public class DeleteContratoActivity extends AppCompatActivity {

    TextView txvStatus,txvData,txvTipo;
    Button btnPDF;
    Intent intent;
    String pdf,id;
    Button btnDeleteContratos;
    ProgressDialog pdg;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delete_contrato);

        intent = getIntent();
       id = intent.getStringExtra("idContrato");
        intent.getStringExtra("status");
        intent.getStringExtra("data");
        intent.getStringExtra("tipo");
        intent.getStringExtra("pdfName");

        txvStatus = (TextView)findViewById(R.id.txvStatus);
        txvData = (TextView)findViewById(R.id.txvData);
        txvTipo = (TextView)findViewById(R.id.txvTipo);

        txvStatus.setText(intent.getStringExtra("status"));
        txvData.setText(intent.getStringExtra("data"));
        txvTipo.setText(intent.getStringExtra("tipo"));
        pdf = intent.getStringExtra("pdfName");

        btnDeleteContratos = (Button)findViewById(R.id.btnDeleteContrato);
        btnDeleteContratos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                pdg = new ProgressDialog(DeleteContratoActivity.this);
                pdg.setTitle("Aguarde...");
                pdg.setMessage("Deletando..");
                pdg.setCancelable(false);
                pdg.show();

                Ion.with(getBaseContext())
                        .load(URL+"contrato/deleteContratoAndroid")
                        .setBodyParameter("id",id)
                        .asJsonObject()
                        .setCallback(new FutureCallback<JsonObject>() {
                            @Override
                            public void onCompleted(Exception e, JsonObject result) {
                                if (result.get("retorno").getAsString().equals("YES")) {
                                    Toast.makeText(getBaseContext(), "Envio deletado com sucesso!", Toast.LENGTH_LONG).show();
                                    startActivity(new Intent(getBaseContext(),IndexActivity.class));
                                } else  {
                                    pdg.dismiss();
                                    Toast.makeText(getBaseContext(), "Erro ao deletar envio !", Toast.LENGTH_LONG).show();
                                    startActivity(new Intent(getBaseContext(),IndexActivity.class));

                                }
                            }
                        });

            }
        });

         btnPDF = (Button) findViewById(R.id.btnPdf);
        btnPDF.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DownloadPDF(URL+"View/Bootstrap/pages/files/"+pdf,"Teste.pdf");
            }
        });


    }


        public void DownloadPDF(String urlpdf, String nome){
            Toast.makeText(getBaseContext(),"Download iniciará em instantes.", Toast.LENGTH_SHORT).show();
            String servicestring = Context.DOWNLOAD_SERVICE;
            DownloadManager downloadmanager;
            downloadmanager = (DownloadManager) getSystemService(servicestring);

            Uri uri = Uri
                    .parse(urlpdf);
            DownloadManager.Request request = new DownloadManager.Request(uri);
            request.setTitle(nome);
            request.setDescription("Baixando...");
            request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
            Long reference = downloadmanager.enqueue(request);

    }

}
