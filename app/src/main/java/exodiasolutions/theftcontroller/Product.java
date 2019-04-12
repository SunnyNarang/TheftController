package exodiasolutions.theftcontroller;

public class Product {
    String seller,id,company,price,image;

    public String getSeller() {
        return seller;
    }

    public void setSeller(String seller) {
        this.seller = seller;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public Product(String seller, String id, String company, String price, String image) {
        this.seller = seller;
        this.id = id;
        this.company = company;
        this.price = price;
        this.image = image;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getCompany() {
        return company;
    }

    public Product(String seller, String id, String company, String price) {
        this.seller = seller;
        this.id = id;
        this.company = company;
        this.price = price;
    }

    public void setCompany(String company) {
        this.company = company;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }
}
