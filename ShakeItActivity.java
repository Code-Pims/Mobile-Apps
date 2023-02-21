package com.dopame.projectdopame;

import androidx.appcompat.app.AppCompatActivity;

// import android.annotation.SuppressLint;
import android.annotation.SuppressLint;
import android.content.Intent;
import android.hardware.SensorEventListener;
import android.os.Bundle;
import android.hardware.Sensor;
import android.hardware.SensorEvent;
import android.hardware.SensorManager;
import android.widget.TextView;
import android.os.CountDownTimer;
import android.content.SharedPreferences;
import android.widget.Button;
import android.view.View;
import android.graphics.Color;
import android.util.TypedValue;
import android.view.Gravity;


public class ShakeItActivity extends AppCompatActivity implements SensorEventListener {

    private SensorManager sensorManager;
    private Sensor accelerometer;

    private TextView textView;

    private int points;
    private CountDownTimer countDownTimer;

    private static final String PREFS_NAME = "MyPrefs";
    private static final String LAST_PLAYED_KEY = "lastPlayed";

    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shake_it);

        sensorManager = (SensorManager) getSystemService(SENSOR_SERVICE);
        accelerometer = sensorManager.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);

        textView = findViewById(R.id.Timeframe);
        textView.setGravity(Gravity.CENTER);
        points = 0;

        // Get the last time the game was played from SharedPreferences
        SharedPreferences prefs = getSharedPreferences(PREFS_NAME, MODE_PRIVATE);
        long lastPlayed = prefs.getLong(LAST_PLAYED_KEY, 0);

        // Check if more than 24 hours have elapsed since the last time the game was played
        long currentTime = System.currentTimeMillis();
        long timeElapsed = currentTime - lastPlayed;
        boolean is24HoursElapsed = timeElapsed > (60 * 60 * 1000);// (24 * 60 * 60 * 1000); << 24 hours in milliseconds
        if (is24HoursElapsed) {
            startShakeItGame();
        } else {
            textView.setText("Come back after " + timeElapsed + " to play again!"); // ("Come back tomorrow to play again!");
            textView.setGravity(Gravity.CENTER);
            textView.setTextSize(TypedValue.COMPLEX_UNIT_SP, 30);
            textView.setTextColor(Color.WHITE);
        }
    }

    private void startShakeItGame() {
        countDownTimer = new CountDownTimer(30000, 1000) {

            @SuppressLint("SetTextI18n")
            public void onTick(long millisUntilFinished) {
                long secondsLeft = millisUntilFinished / 1000;
                textView.setText("Time: " + secondsLeft + "s\n\n" + points);
                textView.setGravity(Gravity.CENTER);
                textView.setTextSize(TypedValue.COMPLEX_UNIT_SP, 40);
            }

            public void onFinish() {
                textView.setText("Time's up!\n\nTotal points: \n" + points);
                stopShakeItGame();
                saveLastPlayedTime();
                textView.setTextSize(TypedValue.COMPLEX_UNIT_SP, 40);
                textView.setGravity(Gravity.CENTER);
            }
        }.start();
        sensorManager.registerListener(this, accelerometer, SensorManager.SENSOR_DELAY_NORMAL);
    }

    private void stopShakeItGame() {
        sensorManager.unregisterListener(this);
    }

    @Override
    public void onSensorChanged(SensorEvent event) {
        float x = event.values[0];
        float y = event.values[1];
        float z = event.values[2];

        if (x > 10 || y > 10 || z > 10) {
            points++;
        }
    }

    @Override
    public void onAccuracyChanged(Sensor sensor, int accuracy) {

    }

    @Override
    protected void onPause() {
        super.onPause();
        // Cancel the CountDownTimer if it is not null
        if (countDownTimer != null) {
            countDownTimer.cancel();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        SharedPreferences prefs = getSharedPreferences(PREFS_NAME, MODE_PRIVATE);
        long lastPlayed = prefs.getLong(LAST_PLAYED_KEY, 0);
        long currentTime = System.currentTimeMillis();
        long timeElapsed = currentTime - lastPlayed;
        boolean is24HoursElapsed = timeElapsed > (60 * 60 * 1000); // (24 * 60 * 60 * 1000); 24 hours in milliseconds
        if (is24HoursElapsed) {
            startShakeItGame();
        }
    }

    private void saveLastPlayedTime() {
        SharedPreferences.Editor editor = getSharedPreferences(PREFS_NAME, MODE_PRIVATE).edit();
        editor.putLong(LAST_PLAYED_KEY, System.currentTimeMillis());
        editor.apply();

        Button page_button = findViewById(R.id.page_button);
        page_button.setVisibility(View.VISIBLE);

        page_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ShakeItActivity.this, HomeActivity.class);
                startActivity(intent);
            }
        });


    }
}