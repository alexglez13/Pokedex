-- Compañero Pokémon guardado por usuario (ejecutar una vez en la BD `pokedex`)

ALTER TABLE `usuarios`
  ADD COLUMN `id_poke_companero` int(11) NULL DEFAULT NULL AFTER `rol`,
  ADD KEY `id_poke_companero` (`id_poke_companero`);

ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_companero` FOREIGN KEY (`id_poke_companero`) REFERENCES `pokemon` (`id_poke`) ON DELETE SET NULL ON UPDATE CASCADE;
