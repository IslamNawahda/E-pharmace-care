-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 04:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(300) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `content2` longtext NOT NULL,
  `image2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `content`, `image`, `title2`, `content2`, `image2`) VALUES
(6, 'About E-Pharmacy', 'The E-Pharmacy Graduation Project is an ambitious endeavor designed to revolutionize the way pharmaceutical services are delivered. This project aims to develop a comprehensive online platform that facilitates the efficient and secure distribution of medications, leveraging the power of digital technology to enhance accessibility and convenience for patients. By integrating advanced features such as virtual consultations with pharmacists,  and personalized medicine recommendations, the platform seeks to address the key challenges faced by traditional pharmacies, including long wait times, limited access in remote areas, and the need for personalized medication management. This e-pharmacy system not only promises to streamline the process of obtaining prescriptions but also aims to provide educational resources to promote better understanding and management of medications among users.', 'bg_1.jpg', 'Summary', 'In addition to the core functionalities, the project emphasizes the importance of user experience by implementing an intuitive and user-friendly interface, making it accessible to a wide range of users, including the elderly and those not technologically savvy.\r\n The system is designed to be integrated with various healthcare providers and insurance companies to facilitate seamless transactions and reimbursements. The project also includes a detailed analysis of market trends and user needs, ensuring that the platform remains relevant and effective in the rapidly evolving healthcare landscape. The culmination of this project is expected to not only enhance the efficiency of pharmaceutical services but also to contribute significantly to public health by improving medication adherence and reducing the incidence of medication errors, thereby paving the way for a more advanced and patient-centric approach to pharmacy services.', 'hero_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminAddress` varchar(255) NOT NULL,
  `adminPhone` varchar(20) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminImage` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminAddress`, `adminPhone`, `adminEmail`, `adminImage`, `adminPass`) VALUES
(1, 'admin', 'tullkarm', '123456789', 'Maysam@admin.com', 'images.jpg', '$2y$10$Aj/IzLszqsEO/Gn7FBRA2.RnrUVJS40eWswz1JeCKdsf4QQtexlRW');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `medicineId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `opened` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `couponId` int(11) NOT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `expiryDate` varchar(255) DEFAULT NULL,
  `discountPercentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`couponId`, `startDate`, `expiryDate`, `discountPercentage`) VALUES
(2, '2023-12-18', '2024-01-18', 10);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `medicineId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `doctorImage` varchar(255) NOT NULL,
  `syndicate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorId`, `name`, `description`, `email`, `password`, `location`, `speciality`, `phone`, `doctorImage`, `syndicate`) VALUES
(23, 'kl', 'hjjhjkhjk', 'test88@test.com', '$2y$10$QzrVTKobifHsJGJReClvoOYKpkWioqbZtrOjPQitDUpeEsVvmNtE.', 'Tubas', 'Obstetrician/Gynecologist', '546654645564', 'kisspng-computer-icons-avatar-social-media-blog-font-aweso-avatar-icon-5b2e99c3c1e473.3568135015297806757942.jpg', 'kisspng-computer-icons-avatar-social-media-blog-font-aweso-avatar-icon-5b2e99c3c1e473.3568135015297806757942.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverId` int(11) NOT NULL,
  `functionalLicense` varchar(255) DEFAULT NULL,
  `deliveryPlaces` varchar(255) DEFAULT NULL,
  `deliveryTime` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `workHours` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineId` int(11) NOT NULL,
  `amplitude` int(44) DEFAULT NULL,
  `expiryDate` varchar(255) DEFAULT NULL,
  `productionDate` varchar(255) DEFAULT NULL,
  `Effect` varchar(255) DEFAULT NULL,
  `Barcode` varchar(255) DEFAULT NULL,
  `Contents` text DEFAULT NULL,
  `toAge` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `forUse` varchar(255) DEFAULT NULL,
  `manufactureCompany` varchar(255) DEFAULT NULL,
  `Complications` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `imageName` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineId`, `amplitude`, `expiryDate`, `productionDate`, `Effect`, `Barcode`, `Contents`, `toAge`, `Name`, `forUse`, `manufactureCompany`, `Complications`, `Description`, `imageName`, `price`, `quantity`) VALUES
(27, 20, '2025-01-01', '2024-01-01', 'A pain reliever and fever reducer', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A pain reliever and fever reducer', 15, 'Acetaminophen (Tylenol)', 'outer', 'Acetaminophen ', 'A pain reliever and fever reducer', 'A pain reliever and fever reducer, often used for headaches, muscle aches, and mild arthritis.', 'Tylenol6001PPS0.jpg', 25, 100),
(28, 225, '2025-01-02', '2024-01-01', 'pain relief, fever reduction, and reducing inflammation.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A nonsteroidal anti-inflammatory drug (NSAID) used for pain relief, fever reduction, and reducing inflammation.', 18, 'Ibuprofen (Advil, Motrin)', 'normal', 'Ibuprofen ', 'A nonsteroidal anti-inflammatory drug (NSAID) used for pain relief, fever reduction, and reducing inflammation.', 'A nonsteroidal anti-inflammatory drug (NSAID) used for pain relief, fever reduction, and reducing inflammation.', '71+sToKOieL.jpg', 50, 120),
(29, 300, '2025-01-01', '2024-01-01', 'to treat pain, fever, and inflammation. It is also used in low doses to prevent blood clots.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'to treat pain, fever, and inflammation. It is also used in low doses to prevent blood clots.', 35, 'Aspirin', 'normal', 'Aspirin', 'to treat pain, fever, and inflammation. It is also used in low doses to prevent blood clots.', 'An NSAID used to treat pain, fever, and inflammation. It is also used in low doses to prevent blood clots.', '71-g7kjSLmL.jpg', 13, 60),
(30, 16, '2026-01-01', '2024-01-01', ' A penicillin antibiotic used to treat various bacterial infections like pneumonia, ear infections, and bronchitis.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', ' A penicillin antibiotic used to treat various bacterial infections like pneumonia, ear infections, and bronchitis.', 25, 'Amoxicillin', 'normal', 'Antibiotic', ' A penicillin antibiotic used to treat various bacterial infections like pneumonia, ear infections, and bronchitis.', ' A penicillin antibiotic used to treat various bacterial infections like pneumonia, ear infections, and bronchitis.', 'AMOXICILLIN-SODIUM-INJECTION.png', 28, 50),
(31, 1000, '2025-01-01', '2024-01-01', 'An ACE inhibitor used to treat high blood pressure and heart failure, and to improve survival after a heart attack.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An ACE inhibitor used to treat high blood pressure and heart failure, and to improve survival after a heart attack.', 25, 'Lisinopril', 'normal', 'Inhibitor', 'An ACE inhibitor used to treat high blood pressure and heart failure, and to improve survival after a heart attack.', 'An ACE inhibitor used to treat high blood pressure and heart failure, and to improve survival after a heart attack.', '11197.jpg', 50, 48),
(32, 29, '2025-01-01', '2024-01-01', 'A statin used to lower cholesterol and reduce the risk of heart disease and stroke.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A statin used to lower cholesterol and reduce the risk of heart disease and stroke.', 35, 'Atorvastatin (Lipitor)', 'normal', 'Atorvastatin', 'A statin used to lower cholesterol and reduce the risk of heart disease and stroke.', 'A statin used to lower cholesterol and reduce the risk of heart disease and stroke.', 'files_products_544465DSC_7258[0e2b46b3d6178921537e072ec9f43bdc].jpg', 90, 89),
(33, 30, '2025-01-01', '2024-01-01', 'Used to treat type 2 diabetes, it helps control blood sugar levels.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'Used to treat type 2 diabetes, it helps control blood sugar levels.', 40, 'Metformin', 'normal', 'Metformin', 'Used to treat type 2 diabetes, it helps control blood sugar levels.', 'Used to treat type 2 diabetes, it helps control blood sugar levels.', 'metformin.jpg', 43, 78),
(34, 20, '2025-01-01', '2024-01-01', 'A calcium channel blocker used to treat high blood pressure and angina (chest pain).', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A calcium channel blocker used to treat high blood pressure and angina (chest pain).', 18, 'Amlodipine (Norvasc)', 'normal', 'Amlodipine (Norvasc)', 'A calcium channel blocker used to treat high blood pressure and angina (chest pain).', 'A calcium channel blocker used to treat high blood pressure and angina (chest pain).', 'Norvasc-5mg-Amlodipine-5mg-Tablets-30-Tablets.jpg', 24, 55),
(35, 30, '2025-02-02', '2024-01-01', 'Another statin used to lower cholesterol and triglycerides in the blood.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'Another statin used to lower cholesterol and triglycerides in the blood.', 20, 'Simvastatin (Zocor)', 'normal', ' cholesterol', 'Another statin is used to lower cholesterol and triglycerides in the blood.', 'Another statin used to lower cholesterol and triglycerides in the blood.', 'zocor-40mg-tablet-simvastatin.jpg', 44, 123),
(36, 20, '2025-01-01', '2024-01-01', 'A bronchodilator used to treat or prevent bronchospasm in people with reversible obstructive airway disease.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A bronchodilator used to treat or prevent bronchospasm in people with reversible obstructive airway disease.', 23, 'Albuterol (ProAir, Ventolin)', 'normal', 'Bronchodilator ', 'A bronchodilator used to treat or prevent bronchospasm in people with reversible obstructive airway disease.', 'A bronchodilator used to treat or prevent bronchospasm in people with reversible obstructive airway disease.', 'C0174872.jpg', 55, 240),
(37, 30, '2025-01-01', '2024-01-01', 'Used to treat nerve pain and seizures.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'Used to treat nerve pain and seizures.', 22, 'Gabapentin (Neurontin)', 'normal', 'Used to treat nerve pain and seizures.', 'Used to treat nerve pain and seizures.', 'Used to treat nerve pain and seizures.', 'Neurontin+cap+300+mg6002PPS0.jpg', 78, 450),
(38, 30, '2025-01-01', '2024-01-01', 'An antidepressant used to treat depression, anxiety disorders, PTSD, and OCD.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An antidepressant used to treat depression, anxiety disorders, PTSD, and OCD.', 25, 'Sertraline (Zoloft)', 'normal', '', 'An antidepressant used to treat depression, anxiety disorders, PTSD, and OCD.', 'An antidepressant used to treat depression, anxiety disorders, PTSD, and OCD.', '3c0f7e9036b22434e6ca3516c8368846.png', 66, 95),
(39, 30, '2025-01-01', '2024-01-01', ' A sedative primarily used for the short-term treatment of sleeping problems.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', ' A sedative primarily used for the short-term treatment of sleeping problems.', 25, 'Zolpidem (Ambien)', 'normal', 'Zolpidem', ' A sedative primarily used for the short-term treatment of sleeping problems.', ' A sedative primarily used for the short-term treatment of sleeping problems.', 'ambien2.jpg', 32, 65),
(40, 30, '2025-01-01', '2024-01-01', 'A proton pump inhibitor used to treat gastroesophageal reflux disease (GERD) and other stomach acid-related conditions.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A proton pump inhibitor used to treat gastroesophageal reflux disease (GERD) and other stomach acid-related conditions.', 25, 'Omeprazole (Prilosec)', 'normal', 'Omeprazole (Prilosec)', 'A proton pump inhibitor used to treat gastroesophageal reflux disease (GERD) and other stomach acid-related conditions.', 'A proton pump inhibitor used to treat gastroesophageal reflux disease (GERD) and other stomach acid-related conditions.', '2843851_Prilo-ProductBG1.png', 26, 78),
(41, 25, '2025-01-01', '2024-01-01', 'A diuretic used to treat high blood pressure and edema (fluid retention).', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A diuretic used to treat high blood pressure and edema (fluid retention).', 20, 'Hydrochlorothiazide', 'normal', 'Hydrochlorothiazide', 'A diuretic used to treat high blood pressure and edema (fluid retention).', 'A diuretic used to treat high blood pressure and edema (fluid retention).', 'hydrochlorothiazide-25.jpg', 48, 45),
(42, 30, '2025-01-01', '2024-01-01', 'An antibiotic used to treat a variety of bacterial infections.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An antibiotic used to treat a variety of bacterial infections.', 21, 'Ciprofloxacin (Cipro)', 'normal', 'Ciprofloxacin (Cipro)', 'An antibiotic used to treat a variety of bacterial infections.', 'An antibiotic used to treat a variety of bacterial infections.', '11076.jpg', 55, 0),
(43, 30, '2025-02-02', '2024-01-01', 'A corticosteroid used to treat a variety of conditions including allergies, skin conditions, and arthritis.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A corticosteroid used to treat a variety of conditions including allergies, skin conditions, and arthritis.', 20, 'Prednisone', 'normal', 'Prednisone', 'A corticosteroid used to treat a variety of conditions including allergies, skin conditions, and arthritis.', 'A corticosteroid used to treat a variety of conditions including allergies, skin conditions, and arthritis.', '671RX_L_vvs_000.jpg', 22, 65),
(44, 30, '2025-01-01', '2024-01-01', 'An antidepressant used to treat major depressive disorder, OCD, and panic disorder.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An antidepressant used to treat major depressive disorder, OCD, and panic disorder.', 20, 'Fluoxetine (Prozac)', 'normal', 'Fluoxetine (Prozac)', 'An antidepressant used to treat major depressive disorder, OCD, and panic disorder.', 'An antidepressant used to treat major depressive disorder, OCD, and panic disorder.', 'AdobeStock_296451948_Editorial_Use_Only-scaled.jpeg', 24, 87),
(45, 30, '2025-01-01', '2024-01-01', 'An anticoagulant used to prevent blood clots.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An anticoagulant used to prevent blood clots.', 18, 'Warfarin (Coumadin)', 'normal', 'Warfarin', 'An anticoagulant used to prevent blood clots.', 'An anticoagulant used to prevent blood clots.', 'Caumadin.png', 79, 52),
(46, 29, '2025-01-01', '2024-01-01', 'An angiotensin II receptor antagonist used mainly to treat high blood pressure (hypertension) and to help protect the kidneys from damage due to diabetes.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An angiotensin II receptor antagonist used mainly to treat high blood pressure (hypertension) and to help protect the kidneys from damage due to diabetes.', 20, 'Losartan', 'normal', 'Losartan', 'An angiotensin II receptor antagonist used mainly to treat high blood pressure (hypertension) and to help protect the kidneys from damage due to diabetes.', 'An angiotensin II receptor antagonist used mainly to treat high blood pressure (hypertension) and to help protect the kidneys from damage due to diabetes.', '8821d8ec905721953ab36aa07f32bbe117cd376e9a9b7b24789969eaa0af31dd.jpg', 40, 45),
(47, 20, '2025-01-01', '2024-01-01', 'Primarily used as an antidepressant, Trazodone can also be effective for treating anxiety and insomnia.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'Primarily used as an antidepressant, Trazodone can also be effective for treating anxiety and insomnia.', 60, 'Trazodone', 'normal', 'Trazodone', 'Primarily used as an antidepressant, Trazodone can also be effective for treating anxiety and insomnia.', 'Primarily used as an antidepressant, Trazodone can also be effective for treating anxiety and insomnia.', 'trazodone-box-new.png', 62, 80),
(48, 30, '2025-01-01', '2024-01-01', 'A medication used in the maintenance treatment of asthma and to relieve symptoms of seasonal allergies.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'A medication used in the maintenance treatment of asthma and to relieve symptoms of seasonal allergies.', 33, 'Montelukast (Singulair)', 'normal', 'Montelukast (Singulair)', 'A medication used in the maintenance treatment of asthma and to relieve symptoms of seasonal allergies.', 'A medication used in the maintenance treatment of asthma and to relieve symptoms of seasonal allergies.', 'pharma_2023_aug_09_52931-a.jpg', 76, 90),
(49, 24, '2025-01-01', '2024-01-01', 'An antidepressant in the selective serotonin reuptake inhibitor (SSRI) class, used to treat depression and generalized anxiety disorder.', '1d-barcode-4fbf513f48675746ba39d9ea5078f377e5e1bb9de2966336088af8394b893b78.png', 'An antidepressant in the selective serotonin reuptake inhibitor (SSRI) class, used to treat depression and generalized anxiety disorder.', 25, 'Escitalopram (Lexapro)', 'normal', 'Escitalopram (Lexapro)', 'An antidepressant in the selective serotonin reuptake inhibitor (SSRI) class, used to treat depression and generalized anxiety disorder.', 'An antidepressant in the selective serotonin reuptake inhibitor (SSRI) class, used to treat depression and generalized anxiety disorder.', 'Lexapro-Working-Uses-Dosage-Benefits-And-More.png', 43, 140);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_delivery`
--

CREATE TABLE `medicine_delivery` (
  `medicineDeliveryId` int(11) NOT NULL,
  `medicineId` int(11) DEFAULT NULL,
  `driverId` int(11) DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `quantityDelivered` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_users`
--

CREATE TABLE `medicine_users` (
  `medicineUserId` int(11) NOT NULL,
  `medicineId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `quantityPurchased` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionId` int(11) NOT NULL,
  `medicineId` int(11) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `prescriptionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(34, 14, 'paypal', '2024-01-07 12:54:22'),
(35, 14, 'paypal', '2024-01-12 00:44:56'),
(36, 14, 'cheque', '2024-01-12 00:45:41'),
(37, 14, 'card', '2024-01-12 00:50:56'),
(38, 18, 'card', '2024-01-12 21:24:24'),
(39, 14, 'bankTransfer', '2024-01-12 21:40:05'),
(40, 14, 'paypal', '2024-01-12 21:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `imgName` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `userType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `address`, `phone`, `email`, `imgName`, `password`, `userType`) VALUES
(15, 'Aya', 'Tullkarn', '1234567890', 'Aya@gmail.com', '1000_F_113416666_a7CuS6cvc6D5P5ezUbsTMexJHm9iAgga.jpg', '$2y$10$KYgLV0J0ukbDbIMStLBdGOUnsyAQRMn1EXw0LPBHoi/Fgeb.OzsAe', 2),
(26, 'Test', 'Tubas', '234234', 'fds@gmail.com', 'user-sign-icon-person-symbol-human-avatar-vector-12693195.jpg', '$2y$10$J0UeAYbzxy5wIxre5lo2i.OjanxpOcFUCH3hJ/8GDZnkWeXd/T1Xy', 2),
(27, 'uiuiuhui', 'fgdgf', '3443433434', 'gthg@fgr.com', 'png-clipart-man-s-face-avatar-computer-icons-user-profile-business-user-avatar-blue-face-thumbnail.png', '$2y$10$CxEmJ4D7Wlvl8hdD9WFE9uLHluVvzYZ9imRCDC1pF2zpbRlAo6wBu', 1),
(28, 'iujhjhu', 'dsre', '3455445', 'fgfg@kjikijj.com', 'kisspng-computer-icons-avatar-login-user-avatar-5ac207e69ecd41.2588125315226654466505.jpg', '$2y$10$ee.7uXMKbR6oSfO.uIWlT.ASX8SUZFQ0OOnLgeT7UalUH0V5FdxjC', 1),
(29, 'kl', 'Tubas', '546654645564', 'test88@test.com', 'kisspng-computer-icons-avatar-social-media-blog-font-aweso-avatar-icon-5b2e99c3c1e473.3568135015297806757942.jpg', '$2y$10$QzrVTKobifHsJGJReClvoOYKpkWioqbZtrOjPQitDUpeEsVvmNtE.', 3),
(30, 'Test', 'Tubas', '1234577142', 'daraghmehhjhh@gmail.com', 'Creative-Tail-People-gentleman.svg.png', '$2y$10$QPfODMbc0WvBaLZPRBD6De4jdcUDyNARrwWa7c3BhSuSMKLbUHa2W', 4),
(31, 'Test', 'Tubas', '1234577142', 'daraghmeh@gmail.com', 'person_3.jpg', '$2y$10$QPfODMbc0WvBaLZPRBD6De4jdcUDyNARrwWa7c3BhSuSMKLbUHa2W', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userscoupon`
--

CREATE TABLE `userscoupon` (
  `id` int(11) NOT NULL,
  `couponId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `endDate` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`couponId`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineId`);

--
-- Indexes for table `medicine_delivery`
--
ALTER TABLE `medicine_delivery`
  ADD PRIMARY KEY (`medicineDeliveryId`),
  ADD KEY `medicineId` (`medicineId`),
  ADD KEY `driverId` (`driverId`);

--
-- Indexes for table `medicine_users`
--
ALTER TABLE `medicine_users`
  ADD PRIMARY KEY (`medicineUserId`),
  ADD KEY `idMedicine` (`medicineId`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionId`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `userscoupon`
--
ALTER TABLE `userscoupon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `userscoupon`
--
ALTER TABLE `userscoupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine_delivery`
--
ALTER TABLE `medicine_delivery`
  ADD CONSTRAINT `medicine_delivery_ibfk_2` FOREIGN KEY (`driverId`) REFERENCES `driver` (`driverId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
