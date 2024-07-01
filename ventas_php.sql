CREATE TABLE empresa (
    id_Empresa int PRIMARY KEY auto_increment,
    RUC VARCHAR(11) not null ,
    NombreEmpresa VARCHAR(45) NOT NULL,
    TelefonoEmpresa int(9) NOT NULL,
    DireccionEmpresa varchar(225) not null,
    EmailEmpresa varchar(100)
 
);
CREATE TABLE persona (
    idPersona int PRIMARY KEY auto_increment,
    DNI_Persona int(8) not null ,
    Nombres VARCHAR(45) NOT NULL,
    PrimerApellido VARCHAR(45) NOT NULL,
    SegundoApellido VARCHAR(45) NOT NULL,
    Telefonoclli int(9) NOT NULL,
    emailcli varchar(45)
 
);

create table roles(
idRoles int primary key auto_increment,
Descripcion varchar(45) not null
);

CREATE TABLE Colaboradores (
    idColaborador INT PRIMARY KEY,
    Usuario VARCHAR(45) NOT NULL,
    contraseña VARCHAR(20),
    fk_idPersona INT,
    fk_idRoles INT,
    FOREIGN KEY (fk_idPersona) REFERENCES persona(idPersona),
    FOREIGN KEY (fk_idRoles) REFERENCES roles(idRoles)
);
create table clienteVenta (
idCliente int primary key not null,
fk_idPersona INT,
    fk_idEmpresa INT,
    FOREIGN KEY (fk_idPersona) REFERENCES persona(idPersona),
    FOREIGN KEY (fk_idEmpresa) REFERENCES empresa(id_Empresa)
);
create table venta (
idVenta int primary key auto_increment,
fechaVenta datetime,
totalVenta decimal(10,2),
fk_idcolaborador INT,
    fk_clienteVenta INT,
    FOREIGN KEY (fk_idcolaborador) REFERENCES Colaboradores(idColaborador),
    FOREIGN KEY (fk_clienteVenta) REFERENCES clienteVenta(idCliente)
);

create table producto (
    idProducto int primary key auto_increment,
    codigo int(11) not null,
    nombreProd varchar(100) not null,
    precioVenta decimal(10,2) not null,
    existencia int(11) not null,
    descricpionProd text,
    fechavencimiento date, 
    fk_idcategoria INT(11),
    fk_idproveedor INT(11),
    FOREIGN KEY (fk_idcategoria) REFERENCES categorias(idCategoria),
    FOREIGN KEY (fk_idproveedor) REFERENCES proveedores(id_Proveedor)
);

create table productoventas (
idProductoVentas int primary key auto_increment,
cantidad int(11) not null,
preciototal decimal(8,2) not null,

fk_idproducto INT(11),
    fk_idventa INT(11),
    FOREIGN KEY (fk_idproducto) REFERENCES producto(idProducto),
    FOREIGN KEY (fk_idventa) REFERENCES venta(idVenta)
);

CREATE TABLE comprobante (
    idComprobante INT PRIMARY KEY,
    comprobanteGenerado Longblob NOT NULL,
    
    fk_idproductoventas INT,
    
    FOREIGN KEY (fk_idproductoventas) REFERENCES productoventas(idProductoVentas)
   
);

