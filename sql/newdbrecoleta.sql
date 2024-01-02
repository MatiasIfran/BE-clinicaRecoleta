-- Cosas a ejecutar en base de datos:

-- Codigo postal
INSERT INTO codpos (codigo, descripcion, usuario, created_at, updated_at) VALUES
    ('2000', 'ROSARIO - SANTA FE', 'admin', NOW(), NOW()),
    ('3000', 'SANTA FE - SANTA FE', 'admin', NOW(), NOW()),
    ('3001C', 'CAYASTA - SANTA FE', 'admin', NOW(), NOW()),
    ('3001R', 'SANTA ROSA - SANTA FE', 'admin', NOW(), NOW()),
    ('3003', 'HELVECIA - SANTA FE', 'admin', NOW(), NOW()),
    ('3005', 'SAN JAVIER - SANTA FE', 'admin', NOW(), NOW()),
    ('3016', 'SANTO TOME - SANTA FE', 'admin', NOW(), NOW()),
    ('3040', 'SAN JUSTO - SANTA FE', 'admin', NOW(), NOW()),
    ('3042', 'MARCELINO ESCALADA - SANTA FE', 'admin', NOW(), NOW()),
    ('3042S', 'COLONIA SILVA - SANTA FE', 'admin', NOW(), NOW()),
    ('3045', 'LA PENCA - SANTA FE', 'admin', NOW(), NOW()),
    ('3046', 'NARE - SANTA FE', 'admin', NOW(), NOW()),
    ('3048', 'VIDELA - SANTA FE', 'admin', NOW(), NOW()),
    ('3050', 'CALCHAQUI - SANTA FE', 'admin', NOW(), NOW()),
    ('3051', 'ALEJANDRA - SANTA FE', 'admin', NOW(), NOW()),
    ('3052', 'LA CRIOLLA - SANTA FE', 'admin', NOW(), NOW()),
    ('3054', 'VERA Y PINTADO - SANTA FE', 'admin', NOW(), NOW()),
    ('3056', 'MARGARITA - SANTA FE', 'admin', NOW(), NOW()),
    ('3057', 'LA GALLARETA - SANTA FE', 'admin', NOW(), NOW()),
    ('3550', 'VERA - SANTA FE', 'admin', NOW(), NOW()),
    ('3551', 'LA BLANCA - SANTA FE', 'admin', NOW(), NOW()),
    ('3553', 'FORTIN OLMOS - SANTA FE', 'admin', NOW(), NOW()),
    ('3555', 'ROMANG - SANTA FE', 'admin', NOW(), NOW()),
    ('3025', 'SOLEDAD - SANTA FE', 'admin', NOW(), NOW()),
    ('3100', 'PARANA - ENTRE RÍOS', 'admin', NOW(), NOW()),
    ('2240', 'CORONDA - SANTA FE', 'admin', NOW(), NOW()),
    ('0000', 'AAA-SIN LOCALIDAD - SANTA FE', 'admin', NOW(), NOW()),
    ('2300', 'RAFAELA - SANTA FE', 'admin', NOW(), NOW()),
    ('3561', 'AVELLANEDA - SANTA FE', 'admin', NOW(), NOW()),
    ('3080', 'ESPERANZA - SANTA FE', 'admin', NOW(), NOW()),
    ('3029', 'EMILIA - SANTA FE', 'admin', NOW(), NOW()),
    ('3081', 'HUMBOLT - SANTA FE', 'admin', NOW(), NOW()),
    ('2252', 'GALVEZ - SANTA FE', 'admin', NOW(), NOW()),
    ('3044', 'GOBERNADOR CRESPO - SANTA FE', 'admin', NOW(), NOW()),
    ('3013', 'SAN CARLOS SUR - SANTA FE', 'admin', NOW(), NOW()),
    ('2451', 'SAN JORGE - SANTA FE', 'admin', NOW(), NOW()),
    ('3023', 'SARMIENTO - SANTA FE', 'admin', NOW(), NOW()),
    ('3011', 'SAN GERONIMO NORTE - SANTA FE', 'admin', NOW(), NOW());

-- Profesionales
INSERT INTO profesionales (Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, Mail, TipoDocumento, NumDocumento, Matricula, Categoria, Cuit, Codigo, created_at, updated_at, usuario)
VALUES
    ('RICARDO', 'TONINI', NULL, NULL, NULL, NULL, NULL, 1, '00', 55, NULL, NULL, '1111', NOW(), NOW(), 'admin'),
    ('GUILLERMO', 'MAGNANO', NULL, NULL, NULL, NULL, NULL, 1, '01', 45, NULL, NULL, '2222', NOW(), NOW(), 'admin'),
    ('ADRIAN', 'ROCCO', NULL, NULL, NULL, NULL, NULL, 1, '02', 58, NULL, NULL, '3333', NOW(), NOW(), 'admin'),
    ('MARCELO', 'BORDON', NULL, NULL, NULL, NULL, NULL, 1, '03', 52, NULL, NULL, '4444', NOW(), NOW(), 'admin'),
    ('VICTORIA', 'LOPEZ CANDIOTI', NULL, NULL, NULL, NULL, NULL, 1, '04', 51, NULL, NULL, '6666', NOW(), NOW(), 'admin'),
    ('PATRICIA', 'BAISSETTO', NULL, NULL, NULL, NULL, NULL, 1, '05', 56, NULL, NULL, '7777', NOW(), NOW(), 'admin'),
    ('MILAGROS', 'CRISTOFOLI', NULL, NULL, NULL, NULL, NULL, 1, '06', NULL, NULL, NULL, '8888', NOW(), NOW(), 'admin'),
    ('ROSALIA', 'MEILAN', NULL, NULL, NULL, NULL, NULL, 1, '07', NULL, NULL, NULL, '9999', NOW(), NOW(), 'admin'),
    ('JUAN', 'MANTARAS', NULL, NULL, NULL, NULL, NULL, 1, '08', NULL, NULL, NULL, '2016', NOW(), NOW(), 'admin'),
    ('SEBASTIAN', 'HILGERT', NULL, NULL, NULL, NULL, NULL, 1, '09', NULL, NULL, NULL, '5432', NOW(), NOW(), 'admin'),
    ('JORGE', 'CORRAL', NULL, NULL, NULL, NULL, NULL, 1, '10', NULL, NULL, NULL, '5555', NOW(), NOW(), 'admin');

-- Obra sociales
INSERT INTO obra_social 
    (codigo, descripcion, codArancel, activa, valor, maxAnual, maxMensual, obraSocial, updated_at, created_at, usuario) 
VALUES 
    ('01', 'PARTICULAR', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('02', 'OTRA OBRA SOCIAL', 'ARANCEL_02', 1, 10.00, 5000, 500, 'Nombre Obra Social', NOW(), NOW(), 'admin'),
    ('11', 'ENERGIA SALUD', '', 1, 0.00, 6, 2, '008', NOW(), NOW(), 'admin'),
    ('12', 'AAPM PROPAG.MEDIC. NO GRA', '', 1, 0.00, 6, 2, '045', NOW(), NOW(), 'admin'),
    ('14', 'AMEP', '', 1, 0.00, 6, 2, '009', NOW(), NOW(), 'admin'),
    ('17', 'SERVESALUD OBLIGATORIO', '', 1, 0.00, 6, 2, '188', NOW(), NOW(), 'admin'),
    ('19', 'AMUR-OPTATIVO', '', 1, 0.00, 6, 1, '076', NOW(), NOW(), 'admin'),
    ('23', 'JERARQUICOS PMI', '', 1, 0.00, 6, 2, '138', NOW(), NOW(), 'admin'),
    ('25', 'CAJA FORENSE', '', 1, 0.00, 6, 2, '110', NOW(), NOW(), 'admin'),
    ('26', 'CAJA DE INGENIEROS', '', 1, 0.00, 6, 2, '111', NOW(), NOW(), 'admin'),
    ('27', 'CIENCIAS ECONOMICAS', '', 1, 0.00, 6, 2, '250', NOW(), NOW(), 'admin'),
    ('29', 'DOCTHOS DIRECTOS', '', 1, 0.00, 6, 2, '164', NOW(), NOW(), 'admin'),
    ('30', 'FARMACIA TRABAJADORES DE', '', 1, 0.00, 6, 2, '033', NOW(), NOW(), 'admin'),
    ('34', 'IAPOS', '', 1, 0.00, 3, 1, '002', NOW(), NOW(), 'admin'),
    ('35', 'IAPOS ACC DE TRABAJO', '', 1, 0.00, 6, 2, '079', NOW(), NOW(), 'admin'),
    ('36', 'OSSEG-INTEGRAL ADHER', '', 1, 0.00, 6, 2, '178', NOW(), NOW(), 'admin'),
    ('39', 'LEY 5110', '', 1, 0.00, 6, 2, '031', NOW(), NOW(), 'admin'),
    ('41', 'MEDIFE PLAN BRONCE EXENTO', '', 1, 0.00, 6, 2, '251', NOW(), NOW(), 'admin'),
    ('43', 'MEDICUS GRAVADOS', '', 1, 0.00, 6, 2, '053', NOW(), NOW(), 'admin'),
    ('44', 'SM SALUD', '', 1, 0.00, 6, 2, '139', NOW(), NOW(), 'admin'),
    ('45', 'NUEVA MEDICINA', '', 1, 0.00, 6, 2, '163', NOW(), NOW(), 'admin'),
    ('46', 'NUEVA MEDICINA SIVENDIA', '', 1, 0.00, 0, 0, '247', NOW(), NOW(), 'admin'),
    ('48', 'OMINT GRAVADOS', '', 1, 0.00, 6, 2, '145', NOW(), NOW(), 'admin'),
    ('52', 'OSPAC ARTE CURAR', '', 1, 0.00, 6, 2, '004', NOW(), NOW(), 'admin'),
    ('53', 'OSPIL INDUSTRIA LECHERA', '', 1, 0.00, 6, 2, '039', NOW(), NOW(), 'admin'),
    ('57', 'OSDE-2210-D.INSCR.', '', 1, 0.00, 6, 2, '179', NOW(), NOW(), 'admin'),
    ('58', 'OSPAVIAL', '', 1, 0.00, 6, 2, '130', NOW(), NOW(), 'admin'),
    ('59', 'SANCOR OSPERCIN-SMP', '', 1, 0.00, 6, 2, '143', NOW(), NOW(), 'admin'),
    ('61', 'PODER JUDICIAL', '', 1, 0.00, 6, 2, '006', NOW(), NOW(), 'admin'),
    ('62', 'PREMED S.A.', '', 1, 0.00, 6, 2, '132', NOW(), NOW(), 'admin'),
    ('64', 'SAT', '', 1, 0.00, 6, 2, '021', NOW(), NOW(), 'admin'),
    ('65', 'SAMA', '', 1, 0.00, 6, 2, '137', NOW(), NOW(), 'admin'),
    ('67', 'SANAT. SANTA FE', '', 1, 0.00, 6, 1, '032', NOW(), NOW(), 'admin'),
    ('69', 'SADAIC', '', 1, 0.00, 6, 2, '092', NOW(), NOW(), 'admin'),
    ('71', 'SANCOR SALUD', '', 1, 0.00, 6, 2, '074', NOW(), NOW(), 'admin'),
    ('74', 'SANTA LUCIA', '', 1, 0.00, 0, 0, '303', NOW(), NOW(), 'admin'),
    ('75', 'SERVESALUD', '', 1, 0.00, 6, 2, '035', NOW(), NOW(), 'admin'),
    ('78', 'OPDEA', '', 1, 0.00, 0, 0, '017', NOW(), NOW(), 'admin'),
    ('79', 'SWISS OBRA SOCIAL EXENTO', '', 1, 0.00, 6, 2, '183', NOW(), NOW(), 'admin'),
    ('80', 'UNL', '', 1, 0.00, 6, 2, '015', NOW(), NOW(), 'admin'),
    ('88', 'ORDEN PRESTADA', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('91', 'CONTROL', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('92', 'UOM', '', 1, 0.00, 0, 0, '310', NOW(), NOW(), 'admin'),
    ('94', 'FEDERADA SALUD', '', 1, 0.00, 6, 1, '060', NOW(), NOW(), 'admin'),
    ('96', 'SUTIAGA (AGUAS/GASEOSAS)', '', 1, 0.00, 6, 2, '346', NOW(), NOW(), 'admin'),
    ('98', 'SM SALUD', '', 1, 0.00, 6, 2, '151', NOW(), NOW(), 'admin'),
    ('99', 'OSFE', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('10', 'PAMI', '', 1, 0.00, 3, 1, '334', NOW(), NOW(), 'admin'),
    ('B2', 'S. AMERICANO', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('C6', 'ASOC. NUEVA CULTURA', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('A5', 'OSAPM', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('B5', 'OSDE-2310-INSCRIPTO', '', 1, 0.00, 6, 2, '180', NOW(), NOW(), 'admin'),
    ('B1', 'AVALIAN -ACA SALUD', '', 1, 0.00, 6, 2, '176', NOW(), NOW(), 'admin'),
    ('A8', 'AMUR OBLIGATORIO DIRECTO', '', 1, 0.00, 6, 1, '175', NOW(), NOW(), 'admin'),
    ('C1', 'MEDICUS OS-EXENTOS', '', 1, 0.00, 6, 2, '149', NOW(), NOW(), 'admin'),
    ('C2', 'FEDERADA SALUD', '', 1, 0.00, 6, 2, '172', NOW(), NOW(), 'admin'),
    ('C5', 'OMINT OB.S EXENTOS', '', 1, 0.00, 6, 2, '150', NOW(), NOW(), 'admin'),
    ('C7', 'OSDOP CEL.SALUD-CONSULT', '', 1, 0.00, 6, 1, '141', NOW(), NOW(), 'admin'),
    ('C8', 'AAPM-CALID', '', 1, 0.00, 0, 0, '300', NOW(), NOW(), 'admin'),
    ('D8', 'OSPLAD', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('D9', 'OSSEG-INTEGRAL SALUD', '', 1, 0.00, 6, 2, '104', NOW(), NOW(), 'admin'),
    ('E0', 'PAMI-OP', '', 1, 0.00, 6, 2, '330', NOW(), NOW(), 'admin'),
    ('E1', 'ART-LA SEGUNDA', '', 1, 0.00, 6, 2, '146', NOW(), NOW(), 'admin'),
    ('E3', 'LUZ Y FZA BASICO', '', 1, 0.00, 0, 0, '196', NOW(), NOW(), 'admin'),
    ('E4', 'MEDICUS', '', 1, 0.00, 6, 2, '082', NOW(), NOW(), 'admin'),
    ('E7', 'MEDIFE ORO-PLATA-PLT -GRA', '', 1, 0.00, 0, 0, '254', NOW(), NOW(), 'admin'),
    ('E8', 'MEDIFE ORO-PLATA-PLT-EXE', '', 1, 0.00, 0, 0, '253', NOW(), NOW(), 'admin'),
    ('E9', 'MEDIFE PLAN BRONCE - GRAV', '', 1, 0.00, 0, 0, '252', NOW(), NOW(), 'admin'),
    ('F0', 'MUTAL FEDERADA', '', 0, 0.00, 0, 0, '070', NOW(), NOW(), 'admin'),
    ('F1', 'MUTAL FEDER.OBRA SOC.', '', 0, 0.00, 0, 0, '185', NOW(), NOW(), 'admin'),
    ('F2', 'SANCOR OSSACRA', '', 1, 0.00, 6, 2, '241', NOW(), NOW(), 'admin'),
    ('F9', 'SANCOR-ART.INTEGRO-MONOTR', '', 1, 0.00, 6, 2, '265', NOW(), NOW(), 'admin'),
    ('G0', 'SANCOR-ART.INTEGRO-RESP.I', '', 0, 0.00, 6, 2, '266', NOW(), NOW(), 'admin'),
    ('G1', 'SWISS OPT DIRECTO GRAVADO', '', 1, 0.00, 6, 2, '153', NOW(), NOW(), 'admin'),
    ('G2', 'LUZ Y FZA-MUTUAL INTERIOR', '', 1, 0.00, 0, 0, '208', NOW(), NOW(), 'admin'),
    ('G3', 'LUZ Y FZA-MUTUAL', '', 1, 0.00, 6, 1, '114', NOW(), NOW(), 'admin'),
    ('G9', 'OSDOP-CEL SALUD-PRACTICAS', '', 1, 0.00, 6, 1, '142', NOW(), NOW(), 'admin'),
    ('H1', 'OSDE-2410-INSCRIPTO', '', 1, 0.00, 6, 2, '204', NOW(), NOW(), 'admin'),
    ('H7', 'ART-PREVENCION', '', 1, 0.00, 6, 2, '094', NOW(), NOW(), 'admin'),
    ('I3', 'ART-MAPFRE', '', 1, 0.00, 6, 2, '262', NOW(), NOW(), 'admin'),
    ('I4', 'AMUR-P.VERDE GRAVADO', '', 1, 0.00, 6, 1, '249', NOW(), NOW(), 'admin'),
    ('I5', 'AMUR-P.VERDE.EXT.CAP EX', '', 1, 0.00, 6, 2, '308', NOW(), NOW(), 'admin'),
    ('I6', 'ENSALUD-MOLINEROS', '', 1, 0.00, 6, 2, '309', NOW(), NOW(), 'admin'),
    ('I7', 'AMUR-P.VERDE  EXENTO', '', 1, 0.00, 6, 1, '248', NOW(), NOW(), 'admin'),
    ('I8', 'ANDAR PLAN CLASICO Y ESP', '', 1, 0.00, 6, 2, '335', NOW(), NOW(), 'admin'),
    ('I9', 'ANDAR PLAN PLUS', '', 1, 0.00, 6, 2, '336', NOW(), NOW(), 'admin'),
    ('J0', 'PAMI S.CRIST', '', 1, 0.00, 3, 1, '338', NOW(), NOW(), 'admin'),
    ('J3', 'CENTRO ASIST.RAF.GRAV', '', 0, 0.00, 6, 2, '322', NOW(), NOW(), 'admin'),
    ('J4', 'CENTRO ASIST.RAF.EXENTO', '', 0, 0.00, 0, 0, '326', NOW(), NOW(), 'admin'),
    ('K8', 'ART-ASOCIART', '', 0, 0.00, 999, 99, '375', NOW(), NOW(), 'admin'),
    ('K3', 'ART-GALENO', '', 0, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('K4', 'GALENO', '', 0, 0.00, 6, 2, '347', NOW(), NOW(), 'admin'),
    ('K9', 'LUIS PASTEUR', '', 1, 0.00, 6, 2, '267', NOW(), NOW(), 'admin'),
    ('L0', 'LUIS PASTEUR V', '', 1, 0.00, 6, 2, '332', NOW(), NOW(), 'admin'),
    ('L2', 'GESTION EN SALUD', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('L4', 'OSPEDIC', '', 1, 0.00,  6, 2, '389', NOW(), NOW(), 'admin'),
    ('L6', 'SINDICATO CAMIONEROS', '', 0, 0.00, 99, 99, '360', NOW(), NOW(), 'admin'),
    ('L7', 'MOSAISTAS-BONACOSA', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('M0', 'ELEVAR', '', 1, 0.00, 0, 0, '182', NOW(), NOW(), 'admin'),
    ('M1', 'DASUTEN', '', 1, 0.00, 0, 0, '381', NOW(), NOW(), 'admin'),
    ('M4', 'OSPATCA', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('M5', 'SMATA', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('M7', 'IOSFA-IOSE-DIBA', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('M6', 'INTEGRAL SALUD', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('M-', 'GRUPO SAN NICOLAS', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('M9', 'ARGUS MUTUAL', '', 0, 0.00, 8, 3, '', NOW(), NOW(), 'admin'),
    ('N2', 'ASIS-(VIGI-MONOT.DOMEST.', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('O4', 'OSIAD-ACEITEROS', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('O5', 'MUTUAL DEL CLERO', '', 1, 0.00, 10, 14, '', NOW(), NOW(), 'admin'),
    ('50', 'OSDOP', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('03', 'BIOMETRIA', '', 0, 0.00, 2, 0, '', NOW(), NOW(), 'admin'),
    ('38', 'FE SALUD', '', 0, 0.00, 10, 5, '', NOW(), NOW(), 'admin'),
    ('N1', 'FERIADO NO DAR TURNOS', '', 1, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('O6', 'PAPELEROS IMAGEN EN SALUD', '', 1, 0.00, 20, 10, '', NOW(), NOW(), 'admin'),
    ('O7', 'PERSONAL DE FARMACIA', '', 0, 0.00, 15, 6, '', NOW(), NOW(), 'admin'),
    ('05', 'ATENCION ESPECIAL', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('31', 'OSSACRA AMAS DE CASA', '', 1, 0.00, 20, 10, '', NOW(), NOW(), 'admin'),
    ('P1', 'ART-OMINT', '', 1, 0.00, 15, 15, '', NOW(), NOW(), 'admin'),
    ('24', 'RETINOGRAFIA', '', 1, 0.00, 100, 20, '', NOW(), NOW(), 'admin'),
    ('N5', 'OCT', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('P2', 'PREVENCION SALUD', '', 1, 0.00, 999, 99, '', NOW(), NOW(), 'admin'),
    ('04', 'LASER', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('15', 'IAPOS RECIPROCIDAD', '', 1, 0.00, 10, 20, '', NOW(), NOW(), 'admin'),
    ('08', 'CAMIONEROS PRIMERO', '', 0, 0.00, 10, 10, '', NOW(), NOW(), 'admin'),
    ('20', 'MEDICIN', '', 0, 0.00, 50, 80, '', NOW(), NOW(), 'admin'),
    ('07', 'OSPIA', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('13', 'INYECCION', '', 1, 0.00, 8, 8, '', NOW(), NOW(), 'admin'),
    ('21', 'OSPIDA', '', 0, 0.00, 10, 5, '', NOW(), NOW(), 'admin'),
    ('18', 'ECOGRAFIA', '', 0, 0.00, 10, 10, '', NOW(), NOW(), 'admin'),
    ('90', 'BAJA VISION', '', 0, 0.00, 0, 0, '', NOW(), NOW(), 'admin'),
    ('66', 'ITER-AF-OSPLAD', '', 0, 0.00, 15, 15, '', NOW(), NOW(), 'admin'),
    ('28', 'ART-INTEGRO', '', 1, 0.00, 151, 0, '', NOW(), NOW(), 'admin'),
    ('32', 'AMOIAC-SUTIAGA', '', 0, 0.00, 20, 20, '', NOW(), NOW(), 'admin'),
    ('09', 'PROTECCION FLIAR', '', 0, 0.00, 30, 30, '', NOW(), NOW(), 'admin'),
    ('33', 'ART PLUS', '', 1, 0.00, 10, 15, '', NOW(), NOW(), 'admin'),
    ('51', 'PERIMETRIA', '', 1, 0.00, 100, 20, '', NOW(), NOW(), 'admin'),
	('68', 'HOSPITAL CULLEN', '', 1, 0.00, 10, 10, '', NOW(), NOW(), 'admin');
 
