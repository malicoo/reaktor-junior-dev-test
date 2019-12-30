<template>
    <div>
        <div class="flex items-center mb-5 border-b pb-3 justify-between">
            <h1 class="font-semibold text-2xl ">
                Packages
            </h1>
            <div class="text-sm">
                <span class="font-semibold">Last Updated:</span> {{ config.time }} - <span class="font-semibold">Packages:</span> {{ config.number }}
            </div>
        </div>
        <div>
            <div>
                <div v-for="l in packages" class="relative pt-8">

                    <div class="font-bold  sticky top-0 right-0  z-10 flex items-center justify-end uppercase text-3xl mb-3">
                        <h2 class="h-16 w-16 z-100  bg-white flex items-center justify-center bg-red-500 text-white rounded-lg">{{ l.letter}}</h2>
                    </div>
                    <ul>
                        <li v-for="p in l.data">
                            <div class="py-2 border-b border-gray-100">
                                <h2 class="font-semibold">
                                    <router-link :to="{name: 'package', params: {'p': p.name}}">{{ p.name }} </router-link>
                                </h2>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <infinite-loading @infinite="fetchPackages">
            </infinite-loading>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import _ from 'lodash';

const api = '/api/packages/';

export default {
    data() {
        return {
            packages: [],
            letter: 0
        };
    },
    computed: {
        letters() {
            var alphas = _.range(
                'a'.charCodeAt(0),
                'z'.charCodeAt(0) + 1
            );
            return _.map(alphas, a => String.fromCharCode(a));
        }
    },

    methods: {
        fetchPackages($state) {
            axios.get(api + this.letters[this.letter])
                .then(response => {
                    this.packages.push({ letter: this.letters[this.letter], data: response.data });
                    if (this.letters[this.letter] != 'z') {
                        this.letter += 1;
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
        }
    }
}
</script>