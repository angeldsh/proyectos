package com.daw2.proyecto.email.service;

public interface EmailService {
    void sendSimpleMessage(String to, String subject, String text);

}
