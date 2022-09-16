INSERT INTO area(id, duoarea, area_name)
VALUES
(1, "NUS" ,"U.S."),(2, "R10","PADD 1"),
(3, "R1X", "PADD 1A"),(4,"R1Y","PADD 1B"),(5,"R1Z","PADD 1C"),(6,"R20","PADD 2"),(7,"R30","PADD 3"),(8,"R40","PADD 4"),(9,"R4N5","NA"),(10,"R50","PADD 5"),(11,"YCUOK","NA");




INSERT INTO product(id, product, product_name)
VALUES (1,"EP00","Crude Oil and Petroleum Products"),(2,"EPC0","Crude Oil"),(3,"EPD0","Distillate Fuel Oil"),(4,"EPD00H","DIstillage Fuel Oil, Greater than 500 ppm sulfur"),(5,"EPDM10","DIstillage Fuel Oil, Greater than 15 to 500 ppm sulfur"),(6,"EPDXL0","DIstillage Fuel Oil, 0 to 15 ppm Sulfur"),(7,"EPJK","Kerosene-Type Jet Fuel"),(8,"EPL0XP","NGPLs/LRGs (Excluding Propane/Propylene"),(9,"EPLLPYN","Propylen NonFuel Use"),(10,"EPPLLPZ","Propane and Propylene"),(11,"EPM0","Total gasoline"),(12,"EPM0C","Conventional Motor Gasoline"),(13,"EPM0CA","Conventional Moter Gasoline with Alcohol"),(14,"EPM0CAG55","Finished Motor Gasoline Conventional>55"),(15,"EPM0CO","Other Conventional Motor Gasoline"),(16,"EPM0F","Finished Motor Gasoline"),(17,"EPM0R","Reformulated Motor Gasoline"),(18,"EPM0RA","Reformulated Motor Gasoline with Alcohol"),(19,"EPOBG","Gasoline Blending Components"),(20,"EPOBGCC","Conventional CBOB Gasoline Blending Components"),(21,"EPOBGCG","Conventional GTAB Gasoline Blending Components"),(22,"EPOGBCO","Conventional Other Gasoine Blending Components"),(23,"EPOBGRG","Reformulated GTAB Gasoline Blending Components"),(24,"EPOBGRR","Motor Gasoline Blending Components Reformulated RBOB"),(25,"EPOBGRRA","Reformulated RBOB with Alcohol Gasoline Blending Components"),(26,"EPOBGRRE","Reformulated RBOB with Either Gasoline Blending Components"),(27,"EPOOXE","Fuel Ethanol"),(28,"EPPA","Asphalt and Road Oil" ),(29,"EPPK","Kerosene"),(30,"EPPO6","Other Oils (Excluding Fuel Ethanol)"),(31,"EPPR","Residual Fuel Oil"),(32,"EPPU","Unfinished Oils");


INSERT INTO process(id, process, process_name)
VALUES (
1,
"SAE",
"Ending Stocks"),(
2,
"SAS",
"Ending Stocks SPR"),(
3,
"SAX",
"Ending Stocks Excluding SPR"),(
4,
"SAXL",
"Ending Stocks Excluding SPR and Lease"),(
5,
"SAXP",
"Ending Stocks Excluding Propylene at Terminal"),(
6,
"SKA",
"Stocks In Transit (on Ships) from Alaska)"),(
7,
"SKB",
"Stocks at Bulk Terminal");



INSERT INTO units(id, units)
VALUES (1, "MBBL");