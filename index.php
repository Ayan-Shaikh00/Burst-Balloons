class Solution {
    /**
     * @param Integer[] $nums
     * @return Integer
     */
    public function maxCoins(array $nums): int {
        // Pad the array with 1 at both ends to handle boundaries easily
        $newNums = array_merge([1], $nums, [1]);
        $n = count($newNums);
        
        // dp[left][right] stores the maximum coins from bursting balloons strictly between left and right
        $dp = array_fill(0, $n, array_fill(0, $n, 0));
        
        // Iterate by the length of the subarray interval
        for ($length = 2; $length < $n; $length++) {
            for ($left = 0; $left < $n - $length; $left++) {
                $right = $left + $length;
                
                // Try every balloon 'k' as the LAST balloon to be burst in this range
                for ($k = $left + 1; $k < $right; $k++) {
                    $coins = $newNums[$left] * $newNums[$k] * $newNums[$right];
                    $coins += $dp[$left][$k] + $dp[$k][$right];
                    
                    $dp[$left][$right] = max($dp[$left][$right], $coins);
                }
            }
        }
        
        return $dp[0][$n - 1];
    }
}
