package com.innertrack.dto;

import java.time.LocalDate;

public class ForecastDay {
    public final LocalDate date;
    public final double minC;
    public final double maxC;
    public final String description;

    public ForecastDay(LocalDate date, double minC, double maxC, String description) {
        this.date = date;
        this.minC = minC;
        this.maxC = maxC;
        this.description = description;
    }
}