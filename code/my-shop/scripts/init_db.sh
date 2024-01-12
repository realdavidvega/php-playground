docker exec -it my-shop-mysql-1 mysql -u root -psomeRootPassword -e "INSERT INTO myShop.products (id, name, price, image) VALUES (1, 'Golden Skull', 14.99, 'golden-skull');"
docker exec -it my-shop-mysql-1 mysql -u root -psomeRootPassword -e "INSERT INTO myShop.products (id, name, price, image) VALUES (2, 'White Tiger', 14.99, 'white-tiger');"
docker exec -it my-shop-mysql-1 mysql -u root -psomeRootPassword -e "INSERT INTO myShop.products (id, name, price, image) VALUES (3, 'Wild', 14.99, 'wild');"
docker exec -it my-shop-mysql-1 mysql -u root -psomeRootPassword -e "INSERT INTO myShop.products (id, name, price, image) VALUES (4, 'Drama Queen', 14.99, 'drama-queen');"
