package exodiasolutions.theftcontroller;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.v4.app.Fragment;
import android.util.Base64;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.facebook.drawee.backends.pipeline.Fresco;
import com.facebook.drawee.generic.GenericDraweeHierarchy;
import com.facebook.drawee.generic.GenericDraweeHierarchyBuilder;
import com.facebook.drawee.generic.RoundingParams;
import com.facebook.drawee.view.SimpleDraweeView;
import com.facebook.imagepipeline.core.ImagePipeline;

import java.io.ByteArrayOutputStream;
import java.io.IOException;

import exodiasolutions.theftcontroller.Custom.Store;

import static android.app.Activity.RESULT_OK;


public class Chain_Frag extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    int PICK_IMAGE_REQUEST = 1;


    Bitmap bitmap = null;

    SimpleDraweeView draweeView;

    exodiasolutions.buzz.Custom.CEditText seller,company,weight,material,stone,size,karat,price,other1,other2;
    Button submit;
    ProgressDialog progressDialog;
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v = inflater.inflate(R.layout.fragment_chain_, container, false);
        progressDialog = new android.app.ProgressDialog(getActivity());
        seller = v.findViewById(R.id.sellerID);
        company = v.findViewById(R.id.company);
        weight = v.findViewById(R.id.weight);
        material = v.findViewById(R.id.material);
        size = v.findViewById(R.id.size);
        karat = v.findViewById(R.id.karat);
        price = v.findViewById(R.id.price);
        submit = v.findViewById(R.id.submit);
        other1 = v.findViewById(R.id.other1);
        other2 = v.findViewById(R.id.other2);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (getActivity().checkSelfPermission(Manifest.permission.READ_EXTERNAL_STORAGE)
                    != PackageManager.PERMISSION_GRANTED) {
                if (shouldShowRequestPermissionRationale(
                        Manifest.permission.READ_EXTERNAL_STORAGE)) {
                }
                requestPermissions(new String[]{Manifest.permission.READ_EXTERNAL_STORAGE},
                        0);
            }
        }


        draweeView = (SimpleDraweeView) v.findViewById(R.id.profile_image);
        Drawable myIcon = getResources().getDrawable( R.drawable.add_photo);
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


        draweeView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
// Show only images, no videos or anything else
                intent.setType("image/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
// Always show the chooser (if there are multiple options available)
                startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST);
            }
        });

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(seller.getText().toString().equalsIgnoreCase(new Store(getActivity()).getValue("userid"))){
                    Toast.makeText(getActivity(), "Can't use your own id!", Toast.LENGTH_SHORT).show();
                    return;
                }
                String encodedImage="";
                if(bitmap!=null) {
                    ByteArrayOutputStream baos = new ByteArrayOutputStream();
                    bitmap.compress(Bitmap.CompressFormat.JPEG, 50, baos);
                    byte[] imageBytes = baos.toByteArray();
                    encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
                   // Toast.makeText(getActivity(), ""+encodedImage, Toast.LENGTH_SHORT).show();
                }
                if(seller.getText().toString().length()>0&&company.getText().toString().length()>0&&weight.getText().toString().length()>0&&material.getText().toString().length()>0&&
                        size.getText().toString().length()>0&&karat.getText().toString().length()>0&&price.getText().toString().length()>0){
                    progressDialog.setMessage("Please Wait");
                    progressDialog.show();
                    final MyHttpClient myHttpClient = new MyHttpClient(getActivity(),"https://vintagevow-sunnynarang.legacy.cs50.io/theft/buy_chain.php",new String[]
                            {"seller",seller.getText().toString(),
                                    "company",company.getText().toString(),
                                    "weight",weight.getText().toString(),
                                    "material",material.getText().toString(),
                                    "size",size.getText().toString(),
                                    "karat",karat.getText().toString(),
                                    "price",price.getText().toString(),
                                    "other1",other1.getText().toString(),
                                    "other2",other2.getText().toString(),
                                    "image",encodedImage,
                                    "buyer",new Store(getActivity()).getValue("userid")
                            });

                    myHttpClient.execute();
                    myHttpClient.callback = new MyCallback() {
                        @Override
                        public void callbackCall() {
                            progressDialog.dismiss();
                            if(myHttpClient.result.equalsIgnoreCase("1")){
                                Toast.makeText(getActivity(), "Done.", Toast.LENGTH_SHORT).show();
                                getActivity().finish();
                            }
                            else{
                                Toast.makeText(getActivity(), "Error, Try Again", Toast.LENGTH_SHORT).show();

                            }
                             }
                    };

                }
                else{
                    Toast.makeText(getActivity(), "Please fill all fields", Toast.LENGTH_SHORT).show();
                }

            }
        });

        return v;
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (requestCode == PICK_IMAGE_REQUEST && resultCode == RESULT_OK && data != null && data.getData() != null) {

            Uri uri = data.getData();

            ImagePipeline imagePipeline = Fresco.getImagePipeline();
            imagePipeline.evictFromCache(uri);
            imagePipeline.clearCaches();
            try {
                bitmap = MediaStore.Images.Media.getBitmap(getActivity().getContentResolver(), uri);
            } catch (IOException e) {
                e.printStackTrace();
            }

            draweeView.setImageURI(uri);


        }
    }

}
