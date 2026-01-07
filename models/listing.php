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
            a.accommodation_is_furnished,
            d.photo_img,
            l.city,
            l.state,
            l.country
        FROM accommodation a
        LEFT JOIN documents d ON a.accommodation_id = d.accommodation_id
        INNER JOIN locations l ON a.location_id = l.location_id
        WHERE 1=1
    ";

    $params = [];

    if ($search !== '') {
        $sql .= " AND a.accommodation_name  LIKE :search";
        $params['search'] = "%$search%";
    }

    if ($city !== '') {
        $sql .= " AND l.city LIKE :city";
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
    $sql = "
        SELECT COUNT(DISTINCT a.accommodation_id)
        FROM accommodation a
        INNER JOIN locations l ON a.location_id = l.location_id
        WHERE 1=1
    ";

    $params = [];

    if ($search !== '') {
        $sql .= " AND a.accommodation_name ILIKE :search";
        $params['search'] = "%$search%";
    }

    if ($city !== '') {
        $sql .= " AND l.city ILIKE :city";
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

    public function getLocations(){
        $sql = "
        SELECT DISTINCT ON (city) *
        FROM locations
        ORDER BY city, location_id;
    ";
    $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrice(){
        $sql = "
        SELECT accommodation_price from accommodation;
    ";
    $stmt = $this->pdo->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    }
?>