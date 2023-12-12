<?php
namespace App\Enums;

enum UserTypes:int {
case Admin = 1;
case Supervisor = 2;

case Arbitrator = 3;
case Competitor = 4;
}
