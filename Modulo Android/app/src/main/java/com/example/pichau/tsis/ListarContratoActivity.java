package com.example.pichau.tsis;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;

import com.example.pichau.tsis.Adapters.AdapterContrato;
import com.example.pichau.tsis.Models.Contrato;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import java.util.ArrayList;


public class ListarContratoActivity extends AppCompatActivity {

    String id;
    ListView ltwHospede;
    TextView txvVazio;
    LinearLayout layout;
    ImageView img;
    SharedPreferences preferences;
    ArrayList<Contrato> listas;
    Activity ctx;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_listar_contrato);
        ctx = this;

    }

    public boolean onCreateOptionsMenu(Menu menu){
        getMenuInflater().inflate(R.menu.mymenu, menu);

        return true;
    }



    @Override

    protected void onResume() {
        super.onResume();

        img = (ImageView) findViewById(R.id.imageViewEmpty);
        layout = (LinearLayout) findViewById(R.id.layoutEmpty);
        ltwHospede = (ListView) findViewById(R.id.ltwView);
        txvVazio = (TextView) findViewById(R.id.emptyElement);


        preferences = getSharedPreferences("USER_INFORMATION", MODE_PRIVATE);
        id = Integer.toString(preferences.getInt("idUsuario", 0));

        listas = new ArrayList<Contrato>();




            Ion.with(getBaseContext()).load(URL+"contrato/listarContratoUser")
                .setBodyParameter("id", id)
                .asJsonArray().setCallback(new FutureCallback<JsonArray>() {
            @Override
            public void onCompleted(Exception e, JsonArray result) {

                if (result != null) {

                    for (int i = 0; i < result.size(); i++) {
                        JsonObject retorno = result.get(i).getAsJsonObject();
                        Contrato contrato = new Contrato();
                        contrato.setId(retorno.get("id_contrato").getAsString());
                        contrato.setStatus(retorno.get("status").getAsString());
                        contrato.setData(retorno.get("data").getAsString());
                        contrato.setTipo(retorno.get("tipo").getAsString());
                        contrato.setPdf(retorno.get("nomePdf").getAsString());
                        listas.add(contrato);


                    }

                    layout.setVisibility(View.GONE);
                    img.setVisibility(View.GONE);
                    ltwHospede.setAdapter(new AdapterContrato(listas, ctx));
                } else {

                    ltwHospede.setVisibility(View.GONE);

                    txvVazio.setText("Vazio");
                }

            }
        });



        ltwHospede.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {


                Contrato obj = (Contrato) parent.getItemAtPosition(position);
                final String idContrato = obj.getId();
                String status = obj.getStatus();
                String data = obj.getData();
                String tipo = obj.getTipo();
                String pdf = obj.getPdf();

                Intent intent = new Intent(getBaseContext(), DeleteContratoActivity.class);
                intent.putExtra("idContrato", idContrato);
                intent.putExtra("status", status);
                intent.putExtra("data", data);
                intent.putExtra("tipo", tipo);
                intent.putExtra("pdfName", pdf);
                startActivity(intent);

            }
        });

    }


    public boolean onOptionsItemSelected(MenuItem item) { //Botão adicional na ToolBar
        int id = item.getItemId();

         if(id == R.id.item6){
            startActivity(new Intent(getBaseContext(),IndexActivity.class));
        }
        else if(id == R.id.update){

          startActivity(new Intent(getBaseContext(),ListarContratoActivity.class));
            finish();

        }
        return true;
    }



    }








