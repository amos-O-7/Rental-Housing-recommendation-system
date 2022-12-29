<?php declare(strict_types=1);

namespace App;

use Exception;

class ProductSimilarity
{
    protected $houses      = [];
    protected $featureWeight  = 1;
    protected $priceWeight    = 1;
    protected $categoryWeight = 1;
    protected $priceHighRange = 1000;

    public function __construct(array $houses)
    {
        $this->houses       = $houses;
        $this->priceHighRange = max(array_column($houses, 'price'));
    }

    public function setFeatureWeight(float $weight): void
    {
        $this->featureWeight = $weight;
    }

    public function setPriceWeight(float $weight): void
    {
        $this->priceWeight = $weight;
    }

    public function setCategoryWeight(float $weight): void
    {
        $this->categoryWeight = $weight;
    }

    public function calculateSimilarityMatrix(): array
    {
        $matrix = [];

        foreach ($this->houses as $house) {

            $similarityScores = [];

            foreach ($this->houses as $_house) {
                if ($house->id === $_house->id) {
                    continue;
                }
                $similarityScores['house_id_' . $_house->id] = $this->calculateSimilarityScore($house, $_house);
            }
            $matrix['house_id_' . $house->id] = $similarityScores;
        }
        return $matrix;
    }

    public function getProductsSortedBySimularity(int $houseId, array $matrix): array
    {
        $similarities   = $matrix['house_id_' . $houseId] ?? null;
        $sortedHouses = [];

        if (is_null($similarities)) {
            throw new Exception('Can\'t find house with that ID.');
        }
        arsort($similarities);

        foreach ($similarities as $houseIdKey => $similarity) {
            $id      = intval(str_replace('house_id_', '', $houseIdKey));
            $houses = array_filter($this->houses, function ($house) use ($id) { return $house->id === $id; });
            if (! count($houses)) {
                continue;
            }
            $house = $houses[array_keys($houses)[0]];
            $house->similarity = $similarity;
            $sortedHouses[] = $house;
        }
        return $sortedHouses;
    }

    protected function calculateSimilarityScore($houseA, $houseB)
    {
        $productAFeatures = implode('', get_object_vars($houseA->features));
        $productBFeatures = implode('', get_object_vars($houseB->features));

        return array_sum([
            (Similarity::hamming($productAFeatures, $productBFeatures) * $this->featureWeight),
            (Similarity::euclidean(
                Similarity::minMaxNorm([$houseA->price], 0, $this->priceHighRange),
                Similarity::minMaxNorm([$houseB->price], 0, $this->priceHighRange)
            ) * $this->priceWeight),
            (Similarity::jaccard($houseA->categories, $houseB->categories) * $this->categoryWeight)
        ]) / ($this->featureWeight + $this->priceWeight + $this->categoryWeight);
    }
}
