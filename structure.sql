CREATE DATABASE IF NOT EXISTS pharmafefo_db ;
USE pharmafefo_db;

-- 1. جدول المستخدمين
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'pharmacien', 'preparateur') NOT NULL
) ;

-- 2. جدول المنتجات
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    reference VARCHAR(100) UNIQUE NOT NULL,
    prix DECIMAL(10, 2) NOT NULL
) ;

-- 3. جدول الشحنات (الـ Lots)
CREATE TABLE lot_stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT NOT NULL,
    numero_lot VARCHAR(100) NOT NULL,
    quantite INT NOT NULL,
    date_peremption DATE NOT NULL,
    statut ENUM('OK', 'WARNING', 'CRITICAL', 'EXPIRED') DEFAULT 'OK',
    CONSTRAINT FK_lot_produit FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
) ;

-- 4. جدول حركات المخزون
CREATE TABLE mouvements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lot_stock_id INT NOT NULL,
    type ENUM('ENTREE', 'SORTIE') NOT NULL,
    quantite INT NOT NULL,
    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_mouvement_lot FOREIGN KEY (lot_stock_id) REFERENCES lot_stocks(id) ON DELETE CASCADE
) ;

-- 5. جدول التنبيهات
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lot_stock_id INT NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    date_notification DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE,
    CONSTRAINT FK_notification_lot FOREIGN KEY (lot_stock_id) REFERENCES lot_stocks(id) ON DELETE CASCADE
);

-- 6. جدول التقارير المخصصة للأدمن
CREATE TABLE rapports_perte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date_rapport DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_perte DECIMAL(10, 2) NOT NULL,
    details TEXT,
    CONSTRAINT FK_rapport_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT
) ;




-- البريد: admin@pharma.com | الكود: admin123
INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Alami', 'Ahmed', 'admin@pharma.com', 'admin123', 'admin');

-- البريد: pharmacien@pharma.com | الكود: pharma123
INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Benjelloun', 'Sanaa', 'pharmacien@pharma.com', 'pharma123', 'pharmacien');

-- البريد: prep@pharma.com | الكود: prep123
INSERT INTO users (nom, prenom, email, password, role) 
VALUES ('Karimi', 'Amine', 'prep@pharma.com', 'prep123', 'preparateur');


INSERT INTO produits (nom, reference, prix) VALUES ('Doliprane 1000mg', 'REF-DOL100', 15.50);
INSERT INTO produits (nom, reference, prix) VALUES ('Augmentin 1g', 'REF-AUG200', 78.40);
INSERT INTO produits (nom, reference, prix) VALUES ('Spasfon', 'REF-SPA300', 25.00);
INSERT INTO produits (nom, reference, prix) VALUES ('Maxilase', 'REF-MAX400', 32.20);
INSERT INTO produits (nom, reference, prix) VALUES ('Voltarene 50mg', 'REF-VOL500', 28.10);


-- 1. شحنة آمنة (صلاحية بعيدة - غاتبان بالخضر)
INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (1, 'LOT-DOL-001', 150, '2027-12-31');

-- 2. شحنة قربات تسالي (أقل من 90 يوم - غاتبان بالليموني/البرتقالي)
INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (1, 'LOT-DOL-002', 45, DATE_ADD(CURDATE(), INTERVAL 45 DAY));

-- 3. شحنة خطيرة جداً (أقل من 30 يوم - غاتبان بالأحمر)
INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (2, 'LOT-AUG-001', 20, DATE_ADD(CURDATE(), INTERVAL 12 DAY));

-- 4. شحنة منتهية الصلاحية (تاريخ قديم - غاتبان بالأحمر ومكتوب فيها منتهي)
INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption) 
VALUES (3, 'LOT-SPA-OLD', 10, '2025-01-01');

-- 5. شحنة أخرى جديدة للـ Voltarenes (آمنة - غاتبان بالخضر)
