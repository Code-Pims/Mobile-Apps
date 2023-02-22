package com.dopame.projectdopame;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class MainActivity extends AppCompatActivity {

    Button QuickBoost;
    Button HomePage;
    Button LeagueTeam;
    private FirebaseAuth Auth;  //To display Player's Username
    private TextView usernameTextView;  //To display Player's Username

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        QuickBoost = findViewById(R.id.QuickBoost);
        HomePage = findViewById(R.id.HomePage);
        LeagueTeam = findViewById(R.id.LeagueTeam);

        // To display Player's Username ------ Down
        Auth = FirebaseAuth.getInstance(); //To display Player's Username
        usernameTextView = findViewById(R.id.username_TextView); //To display Player's Username

        FirebaseUser user = Auth.getCurrentUser();
        if (user != null) {

            String username = user.getDisplayName();
            displayUsername(username);
        } else {

            Intent intent = new Intent(MainActivity.this, LoginActivity.class);
            startActivity(intent);
        }
    }

    @Override
    protected void onStart() {
        super.onStart();
        FirebaseUser user = Auth.getCurrentUser();
        if (user == null) {

            Intent intent = new Intent(MainActivity.this, LoginActivity.class);
            startActivity(intent);
        }
    }
    @SuppressLint("SetTextI18n")
    private void displayUsername(String username) {
        usernameTextView.setText("Welcome, User " + username);

        // To display Player's Username ------ Up

        QuickBoost.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, LoadingActivity.class);
                startActivity(intent);
            }
        });

        HomePage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, HomeActivity.class);
                startActivity(intent);
            }
        });

    }
}
