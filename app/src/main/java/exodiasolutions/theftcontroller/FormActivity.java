package exodiasolutions.theftcontroller;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

import com.facebook.drawee.backends.pipeline.Fresco;

public class FormActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Fresco.initialize(this);
        setContentView(R.layout.activity_form);
        Spinner spinner = (Spinner) findViewById(R.id.spinner2);
        String[] years = {"Select Product","Ring","Vehicle","Purse","Phone","Bangle","Chain","Earring","Necklace"};
        ArrayAdapter<CharSequence> langAdapter = new ArrayAdapter<CharSequence>(FormActivity.this, R.layout.spinner_text, years );
        langAdapter.setDropDownViewResource(R.layout.simple_spinner_dropdown);
        spinner.setAdapter(langAdapter);

        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                // your code here
                if(position == 1){
                    ChangeFragment(new Ring_Frag());
                }
                else if(position == 2){
                    ChangeFragment(new Car_Frag());

                }else if(position == 3){
                    ChangeFragment(new Purse_Frag());
                }else if(position == 4){
                    ChangeFragment(new Phone_Frag());
                }else if(position == 5){
                    ChangeFragment(new Bangle_Frag());
                }else if(position == 6){
                    ChangeFragment(new Chain_Frag());
                }else if(position == 7){
                    ChangeFragment(new Earring_Farg());
                }else if(position == 8){
                    ChangeFragment(new Neclace_Frag());
                }
                else{}


            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here
            }

        });



    }



    public void ChangeFragment(Fragment frag){
             FragmentManager fm = getSupportFragmentManager();
             Fragment fragment = fm.findFragmentById(R.id.fragment_place);

            FragmentTransaction ft = fm.beginTransaction();
            ft.remove(fragment);
            ft.replace(R.id.fragment_place,frag);
            ft.commit();


    }


}
