package com.innertrack.model;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.time.LocalDate;

import static org.junit.jupiter.api.Assertions.*;

class EventTest {

    private Event event;

    @BeforeEach
    void setUp() {
        event = new Event();
    }

    @Test
    void testDefaultStatusIsFalse() {
        assertFalse(event.isStatus());
    }

    @Test
    void testDefaultIsStatutIsFalse() {
        assertFalse(event.isStatut());
    }

    @Test
    void testAllArgsConstructorSetsAllFields() {
        TypeEvent typeEvent = new TypeEvent(1, "Conférence");
        LocalDate date = LocalDate.of(2026, 6, 15);
        LocalDate creation = LocalDate.of(2026, 1, 1);

        Event e = new Event(1, "Yoga", "Description yoga", date, typeEvent, creation, 50, true);

        assertEquals(1, e.getIdEvent());
        assertEquals("Yoga", e.getTitre());
        assertEquals("Description yoga", e.getDescription());
        assertEquals(date, e.getDateEvent());
        assertEquals(typeEvent, e.getTypeEvent());
        assertEquals(creation, e.getDateCreation());
        assertEquals(50, e.getCapacite());
        assertTrue(e.isStatus());
    }

    @Test
    void testSetAndGetIdEvent() {
        event.setIdEvent(10);
        assertEquals(10, event.getIdEvent());
    }

    @Test
    void testSetAndGetTitre() {
        event.setTitre("Conférence santé mentale");
        assertEquals("Conférence santé mentale", event.getTitre());
    }

    @Test
    void testSetAndGetDescription() {
        event.setDescription("Une description détaillée de l'événement.");
        assertEquals("Une description détaillée de l'événement.", event.getDescription());
    }

    @Test
    void testSetAndGetDateEvent() {
        LocalDate date = LocalDate.of(2026, 8, 20);
        event.setDateEvent(date);
        assertEquals(date, event.getDateEvent());
    }

    @Test
    void testSetAndGetTypeEvent() {
        TypeEvent type = new TypeEvent(2, "Atelier");
        event.setTypeEvent(type);
        assertEquals(type, event.getTypeEvent());
        assertEquals("Atelier", event.getTypeEvent().getLibelle());
        assertEquals(2, event.getTypeEvent().getIdTypeEvent());
    }

    @Test
    void testSetAndGetCapacite() {
        event.setCapacite(200);
        assertEquals(200, event.getCapacite());
    }

    @Test
    void testSetStatusToTrue() {
        event.setStatus(true);
        assertTrue(event.isStatus());
    }

    @Test
    void testSetStatutIsAliasForStatus() {
        event.setStatut(true);
        assertTrue(event.isStatut());
        assertTrue(event.isStatus());
    }

    @Test
    void testIsStatutAndIsStatusAreConsistent() {
        event.setStatus(true);
        assertEquals(event.isStatus(), event.isStatut());

        event.setStatus(false);
        assertEquals(event.isStatus(), event.isStatut());
    }

    @Test
    void testSetAndGetDateCreation() {
        LocalDate creation = LocalDate.of(2026, 1, 15);
        event.setDateCreation(creation);
        assertEquals(creation, event.getDateCreation());
    }

    @Test
    void testTypeEventToStringReturnsLibelle() {
        TypeEvent type = new TypeEvent(3, "Forum");
        assertEquals("Forum", type.toString());
    }

    @Test
    void testTypeEventDefaultConstructor() {
        TypeEvent type = new TypeEvent();
        assertEquals(0, type.getIdTypeEvent());
        assertNull(type.getLibelle());
    }
}
