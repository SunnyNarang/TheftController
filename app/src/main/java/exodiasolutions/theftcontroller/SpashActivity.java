package exodiasolutions.theftcontroller;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import exodiasolutions.theftcontroller.Custom.Store;

public class SpashActivity extends AppCompatActivity {
    Thread thread;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        thread = new Thread() {

            @Override
            public void run() {
                try {
                    sleep(2000);

                    if (new Store(SpashActivity.this).getValue("login")!=null&&new Store(SpashActivity.this).getValue("login").equalsIgnoreCase("1")
                            && new Store(SpashActivity.this).getValue("username").length()>0) {


                        Intent intent = new Intent(SpashActivity.this, MainActivity.class);
                        startActivity(intent);
                        finish();


                    }

                    else {

                        Intent intent = new Intent(SpashActivity.this, LoginActivity.class);
                        startActivity(intent);
                        finish();
                    }



                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }

        };
        thread.start();
    }
}
