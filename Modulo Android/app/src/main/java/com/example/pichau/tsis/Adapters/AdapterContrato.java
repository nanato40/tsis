package com.example.pichau.tsis.Adapters;

import android.app.Activity;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.pichau.tsis.Models.Contrato;
import com.example.pichau.tsis.DownloadActivity;
import com.example.pichau.tsis.IndexActivity;
import com.example.pichau.tsis.R;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

/**
 * Created by Pichau on 05/10/2017.
 */

public class AdapterContrato extends BaseAdapter  {

    private final ArrayList<Contrato> contratos;
    private final Activity act;
    private static String URL = "http://tcc2017.com.br/renato/tsis/";

    public AdapterContrato(ArrayList<Contrato> lista, Activity act) {
        this.contratos = lista;
        this.act = act;
    }

    @Override
    public int getCount() {
        return contratos.size();
    }



    @Override
    public Object getItem(int position) {
        return contratos.get(position);
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {

        View view = null;
        if(convertView == null) {

             view = act.getLayoutInflater()
                    .inflate(R.layout.listviewdoacao, parent, false);
        }else{
                view = convertView;
        }

        final Contrato con = contratos.get(position);


        ImageView status = (ImageView)view.findViewById(R.id.imageViewStatus);
        if(con.getStatus().equals("Negado")){
            Picasso.with(act).load(R.drawable.sad).into(status);
        }else if(con.getStatus().equals("Aprovado")){
            Picasso.with(act).load(R.drawable.happy).into(status);

        }else if(con.getStatus().equals("Aguardando")){
            Picasso.with(act).load(R.drawable.wait).into(status);

        }


        TextView txvStatus = (TextView)view.findViewById(R.id.txvStatus);
        txvStatus.setText(con.getStatus());

        TextView txvData = (TextView)view.findViewById(R.id.txvData);
        txvData.setText(con.getData());

        TextView txvTipo = (TextView)view.findViewById(R.id.txvTipo);
        txvTipo.setText(con.getTipo());



        ImageButton btnDeleteList = (ImageButton) view.findViewById(R.id.delete);
        btnDeleteList.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                AlertDialog.Builder alerta = new AlertDialog.Builder(act);
                alerta.setCancelable(false);
                alerta.setTitle("Aviso!");
                alerta

                        .setMessage("Deseja realmente excluir ?")
                        .setCancelable(false)
                        .setPositiveButton("Excluir", new DialogInterface.OnClickListener(){
                            @Override
                            public void onClick (DialogInterface dialog, int which){

                                Ion.with(act)
                                        .load(URL+"contrato/deleteContratoAndroid")
                                        .setBodyParameter("id",con.getId())
                                        .asJsonObject()
                                        .setCallback(new FutureCallback<JsonObject>() {
                                            @Override
                                            public void onCompleted(Exception e, JsonObject result) {
                                                if (result.get("retorno").getAsString().equals("YES")) {
                                                    Toast.makeText(act, "Envio deletado com sucesso!", Toast.LENGTH_LONG).show();
                                                    notifyDataSetChanged();
                                                    act.startActivity(new Intent(act,IndexActivity.class));
                                                } else  {

                                                    Toast.makeText(act, "Erro ao deletar envio !", Toast.LENGTH_LONG).show();
                                                    notifyDataSetChanged();

                                                }
                                            }
                                        });


                            }


                        })
                        .setNegativeButton("Cancelar", new DialogInterface.OnClickListener(){
                            @Override
                            public void onClick (DialogInterface dialog, int which){


                            }





                        });


                AlertDialog alertDialog = alerta.create();
                alertDialog.show();

    }
});

        ImageButton btnBaixaList = (ImageButton) view.findViewById(R.id.pdf);
        btnBaixaList.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                DownloadActivity down = new DownloadActivity();
                down.Download(URL +"View/Bootstrap/pages/files/"+con.getPdf(),con.getPdf(),act);

            }
        });



        return view;
    }
}
