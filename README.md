# Logistik-Hanief

Simple system to manage logistics

## Instructions

### Setup

```shell
git clone https://github.com/Hanips/logistik-hanief.git
cd logistik-hanief
```

Install backend dependencies

```shell
composer install
```

Install frontend dependencies

```shell
npm install
npm run build

```

To launch the project, run these commands:

```shell
php artisan serve
```

### How to Use

Login Account with Role Access

-   Manager Role (Full access to all features, including the dashboard and log activity)
    Email: `manager@gmail.com`
    Pass: `manager123`

-   Admin Role (Access to all features except the dashboard and log activity)
    Email: `admin@gmail.com`
    Pass: `admin123`

-   Staff Role (Limited access, only able to add data and view the index)
    Email: `staff@gmail.com`
    Pass: `staff123`

### Features

-   Login and register

-   Role-based access control

-   Import and export data (Excel)

-   Log activity tracking

-   Weekly bar chart on dashboard for stock statistics

-   Low stock indicator

-   Update profile

### Excel Template (for import data purpose)

kode_barang | quantity | origin | tanggal_masuk
BRG001 | 10 | PT Sawit | 2024-12-20
BRG002 | 500 | PT OSC | 2024-12-21
