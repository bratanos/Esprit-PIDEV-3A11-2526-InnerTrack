package com.innertrack.service;

import javax.sound.sampled.*;
import java.util.ArrayList;
import java.util.List;

public class AudioDeviceService {

    private static AudioDeviceService instance;
    private Mixer.Info selectedMixer;

    private AudioDeviceService() {
    }

    public static AudioDeviceService getInstance() {
        if (instance == null) {
            instance = new AudioDeviceService();
        }
        return instance;
    }

    public List<Mixer.Info> getAvailableMicrophones() {
        List<Mixer.Info> mics = new ArrayList<>();
        Mixer.Info[] mixers = AudioSystem.getMixerInfo();
        for (Mixer.Info info : mixers) {
            Mixer mixer = AudioSystem.getMixer(info);
            Line.Info[] lineInfos = mixer.getTargetLineInfo();
            for (Line.Info lineInfo : lineInfos) {
                if (lineInfo instanceof DataLine.Info) {
                    mics.add(info);
                    break;
                }
            }
        }
        return mics;
    }

    public void setSelectedMixer(Mixer.Info mixer) {
        this.selectedMixer = mixer;
    }

    public Mixer.Info getSelectedMixer() {
        if (selectedMixer == null) {
            List<Mixer.Info> mics = getAvailableMicrophones();
            if (!mics.isEmpty()) {
                selectedMixer = mics.get(0);
            }
        }
        return selectedMixer;
    }

    private TargetDataLine monitoringLine;

    public void startMonitoring() {
        if (monitoringLine != null && monitoringLine.isOpen())
            return;
        Mixer.Info info = getSelectedMixer();
        if (info == null)
            return;
        AudioFormat format = new AudioFormat(16000, 16, 1, true, false);
        DataLine.Info lineInfo = new DataLine.Info(TargetDataLine.class, format);
        try {
            monitoringLine = (TargetDataLine) AudioSystem.getMixer(info).getLine(lineInfo);
            monitoringLine.open(format);
            monitoringLine.start();
        } catch (LineUnavailableException e) {
            System.err.println("Could not start mic monitoring: " + e.getMessage());
        }
    }

    public void stopMonitoring() {
        if (monitoringLine != null) {
            monitoringLine.stop();
            monitoringLine.close();
            monitoringLine = null;
        }
    }

    public double getMicrophoneLevel() {
        if (monitoringLine == null || !monitoringLine.isOpen())
            return 0;
        int available = monitoringLine.available();
        if (available <= 0)
            return 0;
        byte[] buffer = new byte[Math.min(available, 2048)];
        int read = monitoringLine.read(buffer, 0, buffer.length);
        if (read > 0) {
            double sum = 0;
            for (int i = 0; i < read - 1; i += 2) {
                short sample = (short) ((buffer[i + 1] << 8) | (buffer[i] & 0xFF));
                sum += sample * sample;
            }
            double rms = Math.sqrt(sum / (read / 2.0));
            return Math.min((rms * 2.5) / 32768.0, 1.0);
        }
        return 0;
    }
}
