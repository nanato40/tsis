package com.example.pichau.tsis;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.example.pichau.tsis.Models.Tipo;
import com.github.barteksc.pdfviewer.PDFView;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.io.File;
import java.util.ArrayList;

public class EnviarContratoActivity extends AppCompatActivity {
    private int havePhoto = 0;
    private static final String[] tipos = {"Solicitação",
            "Remanejamento", "Desligamento", "Renovação"};
    Spinner spinnerTipo;
    private static String URL = "http://tcc2017.com.br/renato/tsis/contrato/";
    String file;
    Button btnEnviaCon;
    String idSecao, idUsuario, idTipo;
    private static final int READ_REQUEST_CODE = 101;
    ArrayList<String> secao;
    ArrayList<Tipo> secList;
    ArrayAdapter<String> dataAdapterSecao;
    ProgressDialog pdg,load;
    PDFView pdf;
    TextView txvA,txvB,txvC,txvD;
    private BottomNavigationView bottomNavigationView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enviar_contrato);
        new Load().execute();

        spinnerTipo = (Spinner) findViewById(R.id.spinnerTipo);
        btnEnviaCon = (Button) findViewById(R.id.btnEnviarCon);
        txvA = (TextView) findViewById(R.id.txvA);
        txvB = (TextView) findViewById(R.id.txvB);
        txvC = (TextView) findViewById(R.id.txvC);
        txvD = (TextView) findViewById(R.id.txvD);
        btnEnviaCon.setVisibility(View.GONE);

        secList = new ArrayList<Tipo>();
        secao = new ArrayList<String>();

        pdf = (PDFView) findViewById(R.id.pdfView);
        bottomNavigationView = (BottomNavigationView) findViewById(R.id.bottom_nav);
        dataAdapterSecao = new ArrayAdapter<String>(getBaseContext(), android.R.layout.select_dialog_item, secao);
        spinnerTipo.setAdapter(dataAdapterSecao);

        spinnerTipo.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> arg0,
                                       View arg1, int position, long arg3) {
                // TODO Auto-generated method stub

                idTipo = secList.get(position).getIdTipo();


            }

            @Override
            public void onNothingSelected(AdapterView<?> arg0) {
                // TODO Auto-generated method stub
            }
        });

        bottomNavigationView.setOnNavigationItemSelectedListener(
                new BottomNavigationView.OnNavigationItemSelectedListener() {
                    @Override
                    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                        switch (item.getItemId()) {
                            case R.id.action_bottombar_calls:
                                performFileSearch();
                                return true;
                            case R.id.action_bottombar_recents:
                                // Enviar

                                SharedPreferences preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE);

                                idSecao = Integer.toString(preferences.getInt("secaoId", 0));
                                idUsuario = Integer.toString(preferences.getInt("idUsuario", 0));

                                pdg = new ProgressDialog(EnviarContratoActivity.this);
                                pdg.setTitle("Aguarde...");
                                pdg.setMessage("Realizando Envio..");
                                pdg.setCancelable(false);
                                pdg.show();

                                int error = 0;

                                if (havePhoto == 0) {
                                    Toast.makeText(getBaseContext(), "Por Favor, selecione um formulário.", Toast.LENGTH_SHORT).show();
                                    error = 1;
                                    pdg.dismiss();
                                }


                                if (error == 0) {

                                    Ion.with(getBaseContext())
                                            .load(URL+"salvarContrato")
                                            .setMultipartParameter("tipo", idTipo)
                                            .setMultipartParameter("secao", idSecao)
                                            .setMultipartParameter("idUsuario", idUsuario)
                                            .setMultipartFile("pdf", new File(file))
                                            .asJsonObject()
                                            .setCallback(new FutureCallback<JsonObject>() {
                                                @Override
                                                public void onCompleted(Exception e, JsonObject result) {
                                                    if (result.get("retorno").getAsString().equals("YES")) {
                                                        Toast.makeText(getBaseContext(), "Envio realizado com sucesso!", Toast.LENGTH_LONG).show();
                                                        startActivity(new Intent(getBaseContext(), IndexActivity.class));
                                                    } else {
                                                        pdg.dismiss();
                                                        Toast.makeText(getBaseContext(), "Por favor, tente novamente mais tarde !", Toast.LENGTH_LONG).show();
                                                        startActivity(new Intent(getBaseContext(), IndexActivity.class));

                                                    }
                                                }
                                            });
                                }

                                return true;
                            case R.id.action_bottombar_trips:
                                startActivity(new Intent(getBaseContext(), IndexActivity.class));


                                return true;

                        }
                        return false;
                    }
                });

    }
    public void performFileSearch() {

        Intent intent = new Intent(Intent.ACTION_GET_CONTENT);
        intent.setType("application/pdf");
        intent.addCategory(Intent.CATEGORY_OPENABLE);

        try {
            startActivityForResult(Intent.createChooser(intent, "Selecione um arquivo !"), READ_REQUEST_CODE);
        } catch (android.content.ActivityNotFoundException ex) {
            // Potentially direct the user to the Market with a Dialog
            Toast.makeText(this, "Please install a File Manager.",
                    Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode,
                                 Intent resultData) {

        // The ACTION_OPEN_DOCUMENT intent was sent with the request code
        // READ_REQUEST_CODE. If the request code seen here doesn't match, it's the
        // response to some other intent, and the code below shouldn't run at all.

        if (requestCode == READ_REQUEST_CODE && resultCode == Activity.RESULT_OK) {
            // The document selected by the user won't be returned in the intent.
            // Instead, a URI to that document will be contained in the return intent
            // provided to this method as a parameter.
            // Pull that URI using resultData.getData().

            havePhoto = 1;

            Uri uri = null;
            if (resultData != null) {
                uri = resultData.getData();
                file = getPath(getBaseContext(),uri);
                pdf.fromFile(new File(file)).load();

                txvA.setVisibility(View.GONE);
                txvB.setVisibility(View.GONE);
                txvC.setVisibility(View.GONE);
                txvD.setVisibility(View.GONE);


            }else{
                Toast.makeText(getBaseContext(), "Erro ao fazer envio !", Toast.LENGTH_LONG).show();
            }
        }
    }

    public String getPath(Context context, Uri uri) {
        if ("content".equalsIgnoreCase(uri.getScheme())) {
            String[] projection = {"_data"};
            Cursor cursor;

            try {
                cursor = context.getContentResolver().query(uri, projection, null, null, null);
                assert cursor != null;
                int column_index = cursor.getColumnIndexOrThrow("_data");
                if (cursor.moveToFirst()) {
                    return cursor.getString(column_index);
                }
                cursor.close();
            } catch (Exception e) {
                // Eat it
            }
        } else if ("file".equalsIgnoreCase(uri.getScheme())) {
            return uri.getPath();
        }
        return null;
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



    private class Load extends AsyncTask<Void, Void, Void> {



        @Override
        protected Void doInBackground(Void... params) {


            Ion.with(getBaseContext())
                    .load(URL+"listarTipoMobile")
                    .asJsonArray()
                    .setCallback(new FutureCallback<JsonArray>() {
                        @Override
                        public void onCompleted(Exception e, JsonArray result) {

                            for(int i = 0; i < result.size(); i++){
                                JsonObject retorno = result.get(i).getAsJsonObject();

                                Tipo sec = new Tipo();

                                sec.setIdTipo(retorno.get("idTipo").getAsString());
                                sec.setTipo(retorno.get("tipo").getAsString());
                                secList.add(sec);

                                //Popula spinner
                                secao.add(retorno.get("tipo").getAsString());

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

            load = new ProgressDialog(EnviarContratoActivity.this);
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
