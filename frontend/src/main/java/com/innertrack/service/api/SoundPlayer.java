package com.innertrack.service.api;

import javafx.scene.media.Media;
import javafx.scene.media.MediaPlayer;

public class SoundPlayer {
    private MediaPlayer mediaPlayer;

    public void playPreview(String previewUrl) {
        stop();
        try {
            Media media = new Media(previewUrl);
            mediaPlayer = new MediaPlayer(media);
            mediaPlayer.play();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void stop() {
        if (mediaPlayer != null) {
            mediaPlayer.stop();
        }
    }
}
