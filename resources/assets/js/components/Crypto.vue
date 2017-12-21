<template>
    <div>
      <table class="table">
        <thead>
          <tr>
            <td>Rank</td>
            <td>Name</td>
            <td>Symbol</td>
            <td>Price (USD)</td>
            <td>1H</td>
            <td>1D</td>
            <td>1W</td>
            <td>Market Cap (USD)</td>
          </tr>
        </thead>
         <tbody>
    <tr v-for="coin in coins">
      <td>{{ coin.rank }}</td>
      <td><img v-bind:src="getCoinImage(coin.symbol)"> {{ coin.name }}</td>
      <td>{{ coin.symbol }}</td>
      <td>{{ coin.price_usd  }}</td>
      <td v-bind:style="getColor(coin.percent_change_1h)">
        <span v-if="coin.percent_change_1h > 0">+</span>{{ coin.percent_change_1h }}%
      </td>
      <td v-bind:style="getColor(coin.percent_change_24h)">
        <span v-if="coin.percent_change_24h > 0">+</span>{{ coin.percent_change_24h }}%
      </td>
      <td v-bind:style="getColor(coin.percent_change_7d)">
        <span v-if="coin.percent_change_7d > 0">+</span>{{ coin.percent_change_7d }}%
      </td>
      <td>{{ coin.market_cap_usd  }}</td>
    </tr>
      </tbody>
      </table>
    </div>
</template>

<script>
let CRYPTOCOMPARE_API_URI = "https://www.cryptocompare.com";

// The API we're using for grabbing cryptocurrency prices.  The service can be
// found at: https://coinmarketcap.com/api/
let COINMARKETCAP_API_URI = "https://api.coinmarketcap.com";

// The amount of milliseconds (ms) after which we should update our currency
// charts.
let UPDATE_INTERVAL = 60 * 1000;

    export default {
      data() {
        return {
          coins: [],
          coinData: {}
        }
  },
  methods: {
    getCoinData: function() {
      let self = this;

      axios.get(CRYPTOCOMPARE_API_URI + "/api/data/coinlist")
        .then((resp) => {
          this.coinData = resp.data.Data;
          this.getCoins();
        })
    .catch((err) => {
      this.getCoins();
      console.error(err);
    });
    },

    getCoins: function() {
      let self = this;

      axios.get(COINMARKETCAP_API_URI + "/v1/ticker/?limit=10")
      .then((resp) => {
        this.coins = resp.data;
      })
      .catch((err) => {
        console.error(err);
      });
    },

    getCoinImage: function(symbol) {
    //  return CRYPTOCOMPARE_API_URI + this.coinData[symbol].ImageUrl;
    },

    getColor: (num) => {
     return num > 0 ? "color:green;" : "color:red;";
    }
  },

  created: function() {
    this.getCoinData();
  }
       
}
</script>
