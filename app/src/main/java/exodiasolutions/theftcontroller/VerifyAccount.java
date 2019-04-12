package exodiasolutions.theftcontroller;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.pm.PackageManager;
import android.provider.Settings;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.telephony.TelephonyManager;
import android.view.View;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;


import com.github.glomadrian.codeinputlib.CodeInput;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.UUID;

import exodiasolutions.theftcontroller.Custom.Store;

public class VerifyAccount extends AppCompatActivity {
    TextView username;
    ProgressBar progressbar;
    ProgressDialog dialog;
    Button buttBT, sendotp;
    StringBuilder str = new StringBuilder("123456");

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_verify_account);
        buttBT = (Button) findViewById(R.id.verifytbn);
        sendotp = findViewById(R.id.sendotp);
        username = (TextView) findViewById(R.id.username_otp);
        progressbar = (ProgressBar) findViewById(R.id.progressbar);
        progressbar.setVisibility(View.INVISIBLE);
        username.setText(getIntent().getStringExtra("Email"));
        dialog = new ProgressDialog(this);


        sendotp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                dialog.setMessage("Sending OTP, please wait.");
                dialog.show();
                String[] data2 = {"email", getIntent().getStringExtra("Email")};
                final MyHttpClient myHttpClient2 = new MyHttpClient(VerifyAccount.this, "https://vintagevow-sunnynarang.legacy.cs50.io/theft/sendotp.php", data2);
                myHttpClient2.execute();
                myHttpClient2.callback = new MyCallback() {
                    @Override
                    public void callbackCall() {
                        dialog.dismiss();

                        if (myHttpClient2.result.equalsIgnoreCase("1"))
                            Toast.makeText(VerifyAccount.this, "OTP SEND", Toast.LENGTH_SHORT).show();
                        else
                            Toast.makeText(VerifyAccount.this, "Error Occured while Sending OTP", Toast.LENGTH_SHORT).show();
                    }
                };


            }
        });


        buttBT.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                CodeInput cInput = (CodeInput) findViewById(R.id.code);

                Character[] a = cInput.getCode();
                String code = "";
                for (int i = 0; i < a.length; i++) {
                    code += a[i];
                }
                // Toast.makeText(VerifyAccount.this, ""+code, Toast.LENGTH_SHORT).show();
                //if(edit1ED.getText().toString().length()==1&&edit2ED.getText().toString().length()==1&&edit3ED.getText().toString().length()==1&&edit4ED.getText().toString().length()==1&&edit5ED.getText().toString().length()==1&&edit6ED.getText().toString().length()==1)
                if (code.length() == 6) {//Toast.makeText(Otp.this,str.toString(),Toast.LENGTH_SHORT).show();

                    if(new Store(VerifyAccount.this).getValue("device_id")==null){
                        new Store(VerifyAccount.this).setValue("device_id",UUID.randomUUID().toString());
                    }

                    String id= new Store(VerifyAccount.this).getValue("device_id");
                    id = "1";

                    String[] data ={"username",getIntent().getStringExtra("Email"),"otp",code,"device_id", id };
                    final MyHttpClient myHttpClient = new MyHttpClient(VerifyAccount.this,"https://vintagevow-sunnynarang.legacy.cs50.io/theft/verify.php",data);

                    buttBT.setText("");
                    buttBT.setEnabled(false);
                    progressbar.setVisibility(View.VISIBLE);
                    myHttpClient.execute();


                    myHttpClient.callback = new MyCallback() {
                        @Override
                        public void callbackCall() {
                            // Toast.makeText(VerifyAccount.this, ""+myHttpClient.result, Toast.LENGTH_SHORT).show();
                            buttBT.setText("Verify");
                            buttBT.setEnabled(true);
                            progressbar.setVisibility(View.INVISIBLE);

                            try {
                                JSONObject obj = new JSONObject(myHttpClient.result);
                                if(obj.getString("success").equalsIgnoreCase("true")){
                                    Toast.makeText(VerifyAccount.this, "Account Verified", Toast.LENGTH_SHORT).show();
                                    VerifyAccount.this.finish();
                                }
                                else{
                                    Toast.makeText(VerifyAccount.this, "Wrong OTP", Toast.LENGTH_SHORT).show();
                                }

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }


                        }
                    };
                    // ReportLoader rl = new ReportLoader(VerifyAccount.this);
                    // rl.execute();
                }
                else
                    Toast.makeText(VerifyAccount.this, "Enter Valid OTP", Toast.LENGTH_SHORT).show();
            }
        });




    }
}
