INSERT INTO roles (name)
VALUES ('ROLE_CLIENTE');
INSERT INTO roles (name)
VALUES ('ROLE_ADMIN');
INSERT INTO roles (name)
VALUES ('ROLE_EMPLEADO');

INSERT INTO usuarios (username, password, email)
VALUES ('angel-admin', '$2a$10$ZLLV3sFfIsgKylbPFm/Lt.PrFAVm5MYtcYV6h53EZm8uSb4D/MKPC', 'adsolarh01@iescastelar.com');


INSERT INTO usuarios_roles (usuario_id, rol_id)
VALUES (1, 2);


INSERT INTO categorias (nombre)
VALUES ('Entrantes'),
       ('Carnes'),
       ('Pescados'),
       ('Postres'),
       ('Bebidas'),
       ('Pan');

-- Insertar productos
INSERT INTO railway.productos (id, descripcion, imagen, nombre, precio, categoria_id)
VALUES (1, 'Deliciosas croquetas caseras de jamón ibérico', '73c1b215-d689-4ffb-9e81-c3fc44e4312b_croquetas.jpg',
        'Croquetas de Jamón', 8.5, 1),
       (2, 'Clásica ensalada César con pollo a la parrilla, lechuga romana y aderezo cremoso',
        'a893a4c1-d6da-42b8-861f-fa637ebca28c_ensalada.jpg', 'Ensalada César', 10.99, 1),
       (3, 'Selección de verduras a la parrilla con aceite de oliva y hierbas frescas',
        '7fb72894-1bb3-4738-be5b-309aff3ad689_parrillada.png', 'Parrillada de Verduras', 9.5, 1),
       (4, 'Tortilla de patatas española clásica con cebolla y huevos de corral',
        'c7566107-60cb-4e28-a329-e609dbee2e9f_tortilla.jpg', 'Tortilla Española', 7.99, 1),
       (5, 'Chuletón de buey madurado con hueso, asado a la parrilla',
        'f3a91751-287e-4be7-abb2-47ad11eb9647_chuleton.jpg', 'Chuletón de Buey', 24.99, 2),
       (6, 'Solomillo de ternera tierno y jugoso, asado a la parrilla',
        '01589435-06c2-4e6f-a26f-c829296e867a_solomillo.jpg', 'Solomillo de Ternera', 22.99, 2),
       (7, 'Costillas de cerdo marinadas en salsa barbacoa, asadas al horno',
        '9af2007e-bcb4-40f4-b4fa-5a582ddde639_costillas.jpg', 'Costillas de Cerdo BBQ', 13.99, 2),
       (8, 'Paletilla de cordero lechal asada lentamente al horno con hierbas',
        '4bbeccd0-b102-4b23-8ea6-4f3a1afd5bcc_cordero.jpg', 'Cordero Asado al Horno', 26.5, 2),
       (9, 'Filete de merluza en salsa de tomate, pimientos y cebolla',
        '11acac09-babc-474c-a045-cec4da58417f_merluza-al-vapor.jpg', 'Merluza a la Vasca', 15.5, 3),
       (10, 'Pescadilla fresca rebozada y frita, acompañada de limón',
        'be00dd9a-d6f0-42f6-af3d-bd1ae4199e48_pescadilla.jpeg', 'Pescadilla Frita', 11.99, 3),
       (11, 'Lomos de bacalao desalado cocidos en aceite de oliva con ajo y guindilla',
        '8102681f-9ca2-4aa4-8723-f20e753ccbb7_bacalao.jpeg', 'Bacalao al Pil-Pil', 17.5, 3),
       (12, 'Lomos de bacalao cocidos en salsa de tomate, cebolla y pimiento rojo',
        'c0d81d94-9ccc-4522-9bb2-d024b1cb901c_bacalao_vizcaina.jpg', 'Bacalao a la Vizcaína', 18.99, 3),
       (13, 'Deliciosa tarta de chocolate negro con cobertura de chocolate blanco',
        'e8d2c95c-3988-41d0-8027-4055e95c59f9_tarta_chocolate.jpg', 'Tarta de Chocolate', 6.99, 4),
       (14, 'Postre tradicional catalán con base de crema pastelera y caramelo quemado',
        '2f9342c4-b426-4a0e-931d-232d1554ed24_crema_catalana.jpeg', 'Crema Catalana', 5.5, 4),
       (15, 'Helado artesanal de vainilla con pepitas de chocolate y salsa de caramelo',
        '29ef9aee-80f3-4b81-baaf-f032b25e5a3f_helado_vainilla.jpeg', 'Helado de Vainilla', 4.99, 4),
       (16, 'Postre casero de arroz cocido en leche y azúcar, espolvoreado con canela',
        '7dd220d1-c28c-4279-b18f-3eb1d21d299c_arroz_leche.jpg', 'Arroz con Leche', 5.99, 4),
       (17, 'Agua mineral natural en botella de 500 ml', '82e4bfd4-cde1-4423-b8b5-1368f9a7683a_agua_mineral.jpg',
        'Agua Mineral', 1.5, 5),
       (18, 'Botella de vino tinto Rioja crianza, añada 2016', 'be3333b9-0a8c-4a07-b34b-741ad04d3c54_vino.jpg',
        'Vino Tinto Rioja Crianza', 18.99, 5),
       (19, 'Botella de cerveza artesanal IPA, 330 ml', '5c53a0c2-4349-4132-8457-0a2ceb90b139_cerveza.jpg',
        'Cerveza Artesanal IPA', 5.99, 5),
       (20, 'Taza de café espresso recién hecho, 30 ml', 'f759228d-eaf2-4c7e-8a2a-b69c1579041e_cafe.jpg',
        'Café Espresso', 2.5, 5),
       (21, 'Pan de masa madre recién horneado, servido con aceite de oliva y tomate',
        '02c9c6db-1cce-4726-89e8-f81592115530_pan.jpg', 'Pan de la Casa', 3.5, 6);

