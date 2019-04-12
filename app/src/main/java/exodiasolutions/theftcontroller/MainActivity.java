package exodiasolutions.theftcontroller;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import exodiasolutions.theftcontroller.Custom.Store;

public class MainActivity extends AppCompatActivity {

    TextView userid;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);
        userid = findViewById(R.id.userid);
        userid.setText("Your ID : "+new Store(MainActivity.this).getValue("userid"));



    }


    public void logout(View v){
        new Store(MainActivity.this).setValue("username","");
        new Store(MainActivity.this).setValue("login","0");
        Intent i = new Intent(MainActivity.this, LoginActivity.class);
        i.putExtra("remember_not", true);
        startActivity(i);
        finish();
    }

    public void buy(View v){
        Intent i = new Intent(MainActivity.this, FormActivity.class);
        startActivity(i);
    }
    public void bought(View v){
        Intent i = new Intent(MainActivity.this, Sold.class);
        i.putExtra("sold","0");
        startActivity(i);
    }
    public void sold(View v){
        Intent i = new Intent(MainActivity.this, Sold.class);
        i.putExtra("sold","1");
        startActivity(i);
    }




}
