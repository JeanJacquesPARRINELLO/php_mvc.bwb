<?php

namespace Models;

interface Persistable {
   public function load();
   public function update();
   public function remove();
   
}
