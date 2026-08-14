<?php
array_map('unlink', glob(__DIR__ . '/storage/framework/views/*.php'));
echo "View cache cleared successfully.";
