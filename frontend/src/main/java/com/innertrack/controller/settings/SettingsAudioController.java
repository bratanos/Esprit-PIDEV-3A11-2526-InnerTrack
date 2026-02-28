package com.innertrack.controller.settings;

import com.innertrack.service.AudioDeviceService;
import javafx.animation.Animation;
import javafx.animation.KeyFrame;
import javafx.animation.Timeline;
import javafx.fxml.FXML;
import javafx.scene.control.ComboBox;
import javafx.scene.control.ProgressBar;
import javafx.scene.control.ToggleButton;
import javax.sound.sampled.Mixer;
import javafx.util.Duration;

public class SettingsAudioController {

    @FXML
    private ComboBox<Mixer.Info> micComboBox;
    @FXML
    private ProgressBar micTestBar;
    @FXML
    private ToggleButton btnTestMic;

    private final AudioDeviceService audioService = AudioDeviceService.getInstance();
    private Timeline vuMeterTimeline;

    @FXML
    public void initialize() {
        micComboBox.getItems().addAll(audioService.getAvailableMicrophones());

        Mixer.Info current = audioService.getSelectedMixer();
        if (current != null) {
            micComboBox.setValue(current);
        }

        micComboBox.setConverter(new javafx.util.StringConverter<Mixer.Info>() {
            @Override
            public String toString(Mixer.Info object) {
                return object == null ? "" : object.getName();
            }

            @Override
            public Mixer.Info fromString(String string) {
                return null;
            }
        });

        micComboBox.setOnAction(e -> {
            boolean wasMonitoring = btnTestMic.isSelected();
            if (wasMonitoring)
                audioService.stopMonitoring();

            audioService.setSelectedMixer(micComboBox.getValue());

            if (wasMonitoring)
                audioService.startMonitoring();
        });

        setupVuMeter();
    }

    private void setupVuMeter() {
        vuMeterTimeline = new Timeline(new KeyFrame(Duration.millis(50), e -> {
            double level = audioService.getMicrophoneLevel();
            micTestBar.setProgress(level);
        }));
        vuMeterTimeline.setCycleCount(Animation.INDEFINITE);
    }

    @FXML
    private void toggleMicTest() {
        if (btnTestMic.isSelected()) {
            audioService.startMonitoring();
            vuMeterTimeline.play();
            btnTestMic.setText("Arrêter le Test");
        } else {
            vuMeterTimeline.stop();
            audioService.stopMonitoring();
            micTestBar.setProgress(0);
            btnTestMic.setText("Tester le Micro");
        }
    }
}
