<template>
  <span class="navbar-text lead">
    {{ dateTimeString }}
  </span>
</template>


<script>
import moment from 'moment';
moment.locale('de');

export default {
  data(){
    return {
      yearMonthString: '',
      dateTimeString: ''
    }
  },
  created (){
    this.dateTimeString = moment().format('LLL');

    setInterval(() => {
      this.dateTimeString = moment().format('LLL');
    },1000)
  }
}
</script>
