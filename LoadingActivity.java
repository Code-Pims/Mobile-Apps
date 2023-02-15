package com.dopame.projectdopame;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.widget.TextView;

import java.util.Timer;
import java.util.TimerTask;

public class LoadingActivity extends AppCompatActivity {
    TextView textView;
    Timer timer;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loading);

        textView=findViewById(R.id.text_view);

        new CountDownTimer(11000, 1000) {

            @Override
            public void onTick(long millisUntilFinished) {
                textView.setText("Timer:" + millisUntilFinished/1000);
            }

            @Override
            public void onFinish() {
                textView.setText("GAME BEGIN");

            }
        }.start();

        timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
                Intent intent = new Intent(LoadingActivity.this, GameActivity.class);
                startActivity(intent);
                finish();
            }
        }, 14000);
    }
}