<!DOCTYPE html>
<html>
    <body>
        <pre>
            <?php
            // Read JSON file
            $json = file_get_contents('./data/treeinfo.json');

            //Decode JSON
            $json_data = json_decode($json,true);
            //var_dump[$json_data];

            $tree = "Portugal Laurel";
            $category = "";

            $success = false;

            // Traverse array and get the data
            foreach ($json_data as $key => $value)
            {
                if ($json_data[$key]["Tree"] == $tree || $json_data[$key]["Category"] == $category || $json_data[$key]["Conditions (drainage/sun)"] == $tree || $json_data[$key]["Maintenance"] == $tree || $json_data[$key]["Max Height"] == $tree || $json_data[$key]["Growth Rate"] == $tree ||
                $json_data[$key]["Price"] == $tree)
                {
                    print_r($json_data[$key]);
                    $success = true;
                }
            }

            if ($success == false)
            {
                print_r("results not found");
            }

            ?>
        </pre>
    </body>
</html>
