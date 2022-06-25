# About the App

This is Laravel API (no any UI). 
Database has 3 data tables: shops, products and associative table product_shop.
The product_shop table has price field for every entry. It specify the price of associated product in associated shop.

The API has two endpoints: 
- `/api/shops`
- `/api/products`

You can sort and filter `/api/shops` entry point responce by any field and by "pivot" field price.

The `/api/products` entry point of API is just for show all products.

For example you can find all shops with products chipper 10.

Project includes a postman collection with some query examples.
The authorization is throgh the basic middleware, by checking `apikey=123` in GET param

# Requests

Request of all products
```markdown
GET /api/products?apikey=123
```
Request of all shops
```markdown
GET /api/shops?apikey=123
```
Request of all shops sorted by shop category ASC and id DESC
```markdown
GET /api/shops?apikey=123&sort[]=category&sort[]=id,desc
```

Request of all shops, that has products with price **is** 20
```markdown
GET /api/shops?apikey=123&products[price]=20
```
Request of all shops, that has products with price **less** 20
```markdown
GET /api/shops?apikey=123&products[price]=lt:20
```
Request of all shops, that has products with price **less or equel** 20
```markdown
GET /api/shops?apikey=123&products[price]=lte:20
```
Request of all shops, that has products with price **less or equel 20 and name contains "s"**
```markdown
GET /api/shops?apikey=123&products[price]=lte:20&products[name]=like:%s%
```

# Code Description

Working with DB is implemented though Repository design pattern

Directory `app/Repository/Eloquent/Shop/Filters/` storing all the filters available in the API. 

If API gequest consists params like, for example "products=xxx", then ShopsRepository will try to find Products in this directory, then implement it.
This approach simplefies introducing of new params to request. 

If you need to implement, for example, Manufacturers in this API, just add a new file `app/Repository/Eloquent/Shop/Filters/Manufacturers.php`
Then request of all shops, that has manufacturers with **name contains "LTD"**
```markdown
GET /api/shops?apikey=123&manufacturers[name]=like:%LTD%
```
