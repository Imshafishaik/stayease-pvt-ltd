<?php


    class ListingModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

    public function getFiltered($search, $city, $price, $limit, $offset) {
        $sql = "
            SELECT DISTINCT ON (a.accommodation_id)
                a.accommodation_id,
                a.accommodation_name,
                a.accommodation_description,
                a.accommodation_price,
                a.accommodation_available,
                d.photo_img
            FROM accommodation a
            LEFT JOIN documents d ON a.accommodation_id = d.accommodation_id
            WHERE 1=1
        ";

        $params = [];

        if ($search !== '') {
            $sql .= " AND (a.accommodation_name ILIKE :search OR a.accommodation_address ILIKE :search)";
            $params['search'] = "%$search%";
        }

        if ($city !== '') {
            $sql .= " AND a.accommodation_address ILIKE :city";
            $params['city'] = "%$city%";
        }

        if ($price !== '') {
            $sql .= " AND a.accommodation_price <= :price";
            $params['price'] = $price;
        }

        $sql .= " ORDER BY a.accommodation_id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value);
            }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }

           
          public function countFiltered($search, $city, $price) {
        $sql = "SELECT COUNT(DISTINCT a.accommodation_id)
                FROM accommodation a
                WHERE 1=1";

        $params = [];

        if ($search !== '') {
            $sql .= " AND (a.accommodation_name ILIKE :search OR a.accommodation_address ILIKE :search)";
            $params['search'] = "%$search%";
        }

        if ($city !== '') {
            $sql .= " AND a.accommodation_address ILIKE :city";
            $params['city'] = "%$city%";
        }

        if ($price !== '') {
            $sql .= " AND a.accommodation_price <= :price";
            $params['price'] = $price;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int)$stmt->fetchColumn();
    }
    }
?>