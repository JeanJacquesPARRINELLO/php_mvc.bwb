<?php

namespace Models;

interface Persistable {
   public function Create();
   public function Retrieve();
   public function Update();
   public function Delete();
   
}
