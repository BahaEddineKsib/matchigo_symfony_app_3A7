/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.entities;
import java.math.BigInteger;

/**
 *
 * @author PersoPc
 */
public class Delivery {
    private int id;
    private String deliveryGuy;
    private String lang;
    private String attitude;
    private int price;

    public Delivery() {
    }

    public Delivery(int id, String deliveryGuy, String lang, String attitude, int price) {
        this.id = id;
        this.deliveryGuy = deliveryGuy;
        this.lang = lang;
        this.attitude = attitude;
        this.price = price;
    }

    public Delivery( String lang, String attitude, int price) {
        
        this.lang = lang;
        this.attitude = attitude;
        this.price = price;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getDeliveryGuy() {
        return deliveryGuy;
    }

    public void setDeliveryGuy(String deliveryGuy) {
        this.deliveryGuy = deliveryGuy;
    }

    public String getLang() {
        return lang;
    }

    public void setLang(String lang) {
        this.lang = lang;
    }

    public String getAttitude() {
        return attitude;
    }

    public void setAttitude(String attitude) {
        this.attitude = attitude;
    }

    public int getPrice() {
        return price;
    }

    public void setPrice(int price) {
        this.price = price;
    }
    

    
}