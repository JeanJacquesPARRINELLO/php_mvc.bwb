<template>
    
</template>

<script>
    export default {
        name: "Requetes mySql structure"
    }
</script>

<style scoped>

</style>

//  SÉLECTIONNE LE NOM DE TOUTES LES TABLES D'UNE BASE DE DONNÉES
show tables FROM beweb_db WHERE 1

//  SÉLECTIONNE LE NOM DE TOUTES LES COLONNES D'UNE TABLE
SELECT column_name FROM information_schema.columns WHERE table_name = 'annonces'