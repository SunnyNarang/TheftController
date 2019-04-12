package exodiasolutions.theftcontroller;

import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.drawee.backends.pipeline.Fresco;
import com.facebook.drawee.generic.GenericDraweeHierarchy;
import com.facebook.drawee.generic.GenericDraweeHierarchyBuilder;
import com.facebook.drawee.generic.RoundingParams;
import com.facebook.drawee.view.SimpleDraweeView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import exodiasolutions.theftcontroller.Custom.Store;

public class Sold extends AppCompatActivity {

    ArrayList<Product> arraylist = new ArrayList<>();
    CustomAdapter3 adapter;
    ListView list;
    TextView lol;
    ProgressDialog dialog;
    boolean sold = false;
    String link = "";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Fresco.initialize(this);
        setContentView(R.layout.activity_sold);
         lol = findViewById(R.id.head);
        dialog = new ProgressDialog(this);
        if(getIntent().getStringExtra("sold").equalsIgnoreCase("1")){
            link = "https://vintagevow-sunnynarang.legacy.cs50.io/theft/getsold.php";
            lol.setText("Sold Products");
            sold = true;
        }
        else{
            link  = "https://vintagevow-sunnynarang.legacy.cs50.io/theft/getbuy.php";
        }

        list = (ListView) findViewById(R.id.topic_list);
        final MyHttpClient myHttpClient = new MyHttpClient(Sold.this,link,new String[]{"username", new Store(Sold.this).getValue("userid")});
        myHttpClient.execute();
        dialog.setMessage("please wait..");
        dialog.show();
        myHttpClient.callback = new MyCallback() {
            @Override
            public void callbackCall() {
                dialog.dismiss();
                //Toast.makeText(Sold.this, ""+myHttpClient.result, Toast.LENGTH_SHORT).show();
                try {
                    JSONArray array = new JSONArray(myHttpClient.result);

                    for(int i =0 ;i< array.length();i++){
                        JSONObject obj = array.getJSONObject(i);
                        arraylist.add(new Product(obj.getString("seller_name"),obj.getString("buy_id"),obj.getString("comp"),obj.getString("price"),obj.getString("image")));
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }

                adapter=new CustomAdapter3(Sold.this,arraylist);
                list.setAdapter(adapter);

            }
        };

    }


    class CustomAdapter3 extends ArrayAdapter<Product> {
        Context c;

        public CustomAdapter3(Context context, ArrayList<Product> arrayList) {
            super(context, R.layout.card, arrayList);
            this.c = context;
        }


        @Override
        public View getView(int pos, View convertView, ViewGroup parent) {

            LayoutInflater li = (LayoutInflater) c.getSystemService(c.LAYOUT_INFLATER_SERVICE);
            convertView = li.inflate(R.layout.card, parent, false);

            Product topic_class = getItem(pos);

            TextView file_name1 = (TextView) convertView.findViewById(R.id.topic_name1);

            TextView file_name2 = (TextView) convertView.findViewById(R.id.topic_name2);

            TextView file_name3 = (TextView) convertView.findViewById(R.id.topic_name3);

            TextView file_name4 = (TextView) convertView.findViewById(R.id.topic_name4);

            SimpleDraweeView draweeView = convertView.findViewById(R.id.profile_image);


            Drawable myIcon = getResources().getDrawable( R.drawable.item);
            GenericDraweeHierarchyBuilder builder =
                    new GenericDraweeHierarchyBuilder(getResources());
            GenericDraweeHierarchy hierarchy = builder
                    .setFadeDuration(300)
                    .setPlaceholderImage(myIcon)
                    .build();
            draweeView.setHierarchy(hierarchy);

            RoundingParams roundingParams = RoundingParams.fromCornersRadius(5f).setBorder(getResources().getColor(R.color.border), 5.0f);;
            roundingParams.setRoundAsCircle(true);
            draweeView.getHierarchy().setRoundingParams(roundingParams);

            Uri imageUri = Uri.parse("https://vintagevow-sunnynarang.legacy.cs50.io/theft/img/"+topic_class.getImage());
            Fresco.getImagePipeline().evictFromCache(imageUri);
            draweeView.setImageURI(imageUri);


            file_name1.setText("Purchase Id: "+Html.fromHtml(topic_class.getId()));

            file_name2.setText("Company: "+Html.fromHtml(topic_class.getCompany()));

            file_name3.setText("Price: "+Html.fromHtml(topic_class.getPrice()));
            if(sold){
                file_name4.setText("Sold to: " + Html.fromHtml(topic_class.getSeller()));
            }
            else {
                file_name4.setText("Seller Name: " + Html.fromHtml(topic_class.getSeller()));
            }

            return convertView;

        }
    }
}
