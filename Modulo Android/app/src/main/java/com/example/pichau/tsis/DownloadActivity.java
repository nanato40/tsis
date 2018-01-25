package com.example.pichau.tsis;

import android.app.Activity;
import android.app.DownloadManager;
import android.content.Context;
import android.net.Uri;
import android.os.Build;
import android.os.Environment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.Toast;

public class DownloadActivity extends AppCompatActivity {

    ImageButton btnSolicitar1;
    ImageButton btnDesligamento1;
    ImageButton btnRecesso1;
    ImageButton btnRemanejamento1;
    ImageButton btnRenovacao1;
    Activity ctx2;
    private static  String PATH ="http://tcc2017.com.br/renato/tsis/View/Bootstrap/pages/pdfs/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_download);
        ctx2 = this;
        btnSolicitar1 = (ImageButton)findViewById(R.id.btnSolicitar);
        btnDesligamento1 = (ImageButton) findViewById(R.id.btnDesligamento);
        btnRecesso1 = (ImageButton) findViewById(R.id.btnRecesso);
        btnRemanejamento1 = (ImageButton) findViewById(R.id.btnRemanejamento);
        btnRenovacao1 = (ImageButton) findViewById(R.id.btnRenovacao);

        btnSolicitar1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                Download(PATH +"solicitacao.pdf", "Formulário de Solicitação",ctx2);
            }
        });

        btnDesligamento1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Download(PATH +"desligamento.pdf", "Formulário de Desligamento",ctx2);
            }
        });

        btnRecesso1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Download(PATH +"recesso.pdf","Formulário de Recesso",ctx2);
            }
        });

        btnRemanejamento1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Download(PATH +"remanejamento.pdf","Formulário de Remanejamento",ctx2);
            }
        });

        btnRenovacao1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Download(PATH+"renovacao.pdf","Formulário de Renovação",ctx2);
            }
        });



    }

    public void Download(String urlpdf, String nome, Activity ctx){
        Toast.makeText(ctx,"Download iniciará em instantes!", Toast.LENGTH_SHORT).show();

        DownloadManager downloadmanager;
        downloadmanager = (DownloadManager) ctx.getSystemService(Context.DOWNLOAD_SERVICE);

        Uri uri = Uri
                .parse(urlpdf);
        DownloadManager.Request request = new DownloadManager.Request(uri);
        request.setTitle(nome);
        request.setDescription("Baixando...");
        request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
        Long reference = downloadmanager.enqueue(request);
    }


}
