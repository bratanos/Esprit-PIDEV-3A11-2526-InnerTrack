package com.innertrack.dto;

public class WeatherInfo {
    public final String city;
    public final double tempC;
    public final int humidity;
    public final double windMs;
    public final String description;
    public final String iconId;

    public WeatherInfo(String city, double tempC, int humidity, double windMs, String description, String iconId) {
        this.city = city;
        this.tempC = tempC;
        this.humidity = humidity;
        this.windMs = windMs;
        this.description = description;
        this.iconId = iconId;
    }
}