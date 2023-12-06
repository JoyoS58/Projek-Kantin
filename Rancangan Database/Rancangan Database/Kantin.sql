/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30/11/2023 23:56:46                          */
/*==============================================================*/


drop table if exists DETAIL_TRANSAKSI;

drop table if exists PRODUK;

drop table if exists SUPPLIER;

drop table if exists TRANSAKSI;

drop table if exists TRANSAKSI_SUPPLIER;

drop table if exists USER;

/*==============================================================*/
/* Table: DETAIL_TRANSAKSI                                      */
/*==============================================================*/
create table DETAIL_TRANSAKSI
(
   ID_DETAIL_TRANSAKSI  int not null,
   ID_PRODUK            int,
   ID_TRANSAKSI         int,
   QTY                  int not null,
   HARGA                decimal(10,3) not null,
   SUB_TOTAL            decimal(10,3) not null,
   primary key (ID_DETAIL_TRANSAKSI)
);

/*==============================================================*/
/* Table: PRODUK                                                */
/*==============================================================*/
create table PRODUK
(
   ID_PRODUK            int not null,
   NAMA_PRODUK          varchar(100) not null,
   KATEGORI             varchar(100) not null,
   STOK                 int not null,
   HARGA_JUAL           decimal(10,3) not null,
   primary key (ID_PRODUK)
);

/*==============================================================*/
/* Table: SUPPLIER                                              */
/*==============================================================*/
create table SUPPLIER
(
   ID_SUPPLIER          int not null,
   NAMA_SUPPLIER        varchar(100) not null,
   NO_TELP              varchar(15) not null,
   primary key (ID_SUPPLIER)
);

/*==============================================================*/
/* Table: TRANSAKSI                                             */
/*==============================================================*/
create table TRANSAKSI
(
   ID_TRANSAKSI         int not null,
   ID_USER              int,
   JENIS_PEMBAYARAN     varchar(20) not null,
   TGL_TRANSAKSI        date not null,
   JUMLAH_BAYAR         decimal(10,3) not null,
   SISA_BAYAR           decimal(10,3) not null,
   TOTAL_HARGA          decimal(10,3) not null,
   primary key (ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: TRANSAKSI_SUPPLIER                                    */
/*==============================================================*/
create table TRANSAKSI_SUPPLIER
(
   ID_TRANSAKSI_SUPPLIER int not null,
   ID_PRODUK            int,
   ID_SUPPLIER          int,
   HARGA_SUPPLIER       decimal(10,3) not null,
   JUMLAH_PRODUK        int not null,
   TGL_SUPPLY           date not null,
   "RETURN"             decimal(10,3) not null,
   primary key (ID_TRANSAKSI_SUPPLIER)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              int not null,
   USERNAME             varchar(50) not null,
   PASSWORD             varchar(50) not null,
   LEVEL                varchar(30) not null,
   primary key (ID_USER)
);

alter table DETAIL_TRANSAKSI add constraint FK_MEMILIKI foreign key (ID_TRANSAKSI)
      references TRANSAKSI (ID_TRANSAKSI) on delete restrict on update restrict;

alter table DETAIL_TRANSAKSI add constraint FK_TERLIBAT foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK) on delete restrict on update restrict;

alter table TRANSAKSI add constraint FK_MELAYANI foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table TRANSAKSI_SUPPLIER add constraint FK_MELAKUKAN foreign key (ID_SUPPLIER)
      references SUPPLIER (ID_SUPPLIER) on delete restrict on update restrict;

alter table TRANSAKSI_SUPPLIER add constraint FK_MELIBATKAN foreign key (ID_PRODUK)
      references PRODUK (ID_PRODUK) on delete restrict on update restrict;

