<template>
    <div>
      <table class="table">
        <thead>
          <tr>
            <td>Rank</td>
            <td>Name</td>
            <td>Symbol</td>
            <td>Price (USD)</td>
            <td>Price (EUR)</td>
            <td>1H</td>
            <td>1D</td>
            <td>1W</td>
            <td>Market Cap (USD)</td>
          </tr>
        </thead>
         <tbody>
    <tr v-for="coin in test">
      <td>{{ coin.rank }}</td>
      <td><img v-bind:src="getCoinImageTest(coin.symbol)"> {{ coin.name }}</td>
      <td>{{ coin.symbol }}</td>
      <td>{{ coin.price_usd | currency }}</td>
      <td>{{ coin.price_eur | currency('€') }}</td>
      <td v-bind:style="getColor(coin.percent_change_1h)">
        <span v-if="coin.percent_change_1h > 0">+</span>{{ coin.percent_change_1h }}%
      </td>
      <td v-bind:style="getColor(coin.percent_change_24h)">
        <span v-if="coin.percent_change_24h > 0">+</span>{{ coin.percent_change_24h }}%
      </td>
      <td v-bind:style="getColor(coin.percent_change_7d)">
        <span v-if="coin.percent_change_7d > 0">+</span>{{ coin.percent_change_7d }}%
      </td>
      <td>{{ coin.market_cap_usd | currency  }}</td>
    </tr>
      </tbody>
      </table>
    </div>
</template>

<script>
let CRYPTOCOMPARE_API_URI = "https://min-api.cryptocompare.com";
let CRYPTOCOMPARE_URI = "https://www.cryptocompare.com/";

// The API we're using for grabbing cryptocurrency prices.  The service can be
// found at: https://coinmarketcap.com/api/
let COINMARKETCAP_API_URI = "https://api.coinmarketcap.com/";

// The amount of milliseconds (ms) after which we should update our currency
// charts.
let UPDATE_INTERVAL = 60 * 1000;

    export default {
      data() {
        return {
          coins: [],
          coinData: {},
          test: [],
          Image: {}
        }
  },
  methods: {
    getCoinData: function() {
      let self = this;

      axios.get(CRYPTOCOMPARE_API_URI + "/data/all/coinlist")
        .then((resp) => {
          this.coinData = resp.data.Data;
          this.getCoins();
        })
    .catch((err) => {
      this.getCoins();
      console.log(err);
    });
    },

    getCoins: function() {
      let self = this;

      axios.get(COINMARKETCAP_API_URI + "v1/ticker/?limit=10", {
        mode: 'no-cors',
        withCredentials: false,
        responseType: 'json',
        headers: { 'Access-Control-Allow-Origin': '*',
        'Content-Type': 'text/html',
        'X-Requested-With': 'XMLHttpRequest'
        },
      })
      .then((resp) => {
        this.coins = resp.data;
      })
      .catch((err) => {
        console.log(err);
      });
    },

    getCoinsTest() {
      let self = this;
      axios.get('https://api.coinmarketcap.com/v1/ticker/?convert=EUR&limit=10')
      .then(response => this.test = response.data);
    },

    getCoinDataTest() {
      let self = this;

      axios.get(CRYPTOCOMPARE_API_URI + "/data/all/coinlist")
      .then(response => this.coinData = response.data);
    },

   getCoinImageTest(symbol) {
     //return CRYPTOCOMPARE_URI + this.coinData.Data[symbol].ImageUrl;
     //console.log(CRYPTOCOMPARE_URI + this.coinData.Data[symbol].ImageUrl)
   },
   
   getCoinImage: function(symbol) {

      // These two symbols don't match up across API services. I'm manually
      // replacing these here so I can find the correct image for the currency.
      //
      // In the future, it would be nice to find a more generic way of searching
      // for currency images
      symbol = (symbol === "MIOTA" ? "IOT" : symbol);
      symbol = (symbol === "VERI" ? "VRM" : symbol);

      //return CRYPTOCOMPARE_URI + this.coinData[symbol].ImageUrl;
    },

    getColor: (num) => {
     return num > 0 ? "color:green;" : "color:red;";
    }
  },

  created: function() {
    //this.getCoinData();
    //this.getCoins();
    this.getCoinsTest();
    this.getCoinDataTest();
    
  },

  mounted() {
    //this.getCoinImageTest();
  }
       
}
</script>
