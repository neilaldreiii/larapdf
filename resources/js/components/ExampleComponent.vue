<template>
    <div class="container">
        <div class="border">
            <div ref="content">
                <div class="d-flex justify-content-between">
                    <p>Logo: <img :src="logo" alt="" id="logo" style="width: 200px; height: 200px"></p>
                    <p>Brand: <img :src="brand" alt="" id="brand" style="width: 200px; height: 200px"></p>
                </div>
                <div v-for="info in infos" :key="info.index" class="card mb-3">
                    <div class="card-header">
                        <h1>{{ info.title }}</h1>
                    </div>
                    <div class="card-body">
                        <h2>{{ info.description }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button @click="createPDF" class="btn btn-success">Generate</button>
    </div>
</template>

<script>
import * as jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

export default {
    props: ['storage'],
    data(){
        return {
            infos: [
                {
                    id: 1,
                    title: "Hello World",
                    description: "World is cruel",
                    image: "electric"
                },
                {
                    id: 2,
                    title: "Hello Samurai",
                    description: "Samurai Champloo",
                    image: "fighting"
                },
                {
                    id: 3,
                    title: "Hello Bananas",
                    description: "Bananas are always Here",
                    image: "normal"
                }
            ],
            logo: this.storage + 'water.png',
            brand: this.storage + 'electric.png'
        }
    },
    methods: {
        createPDF () {
            console.log("Generating");
            
            const doc = new jsPDF({
                orientation: 'l',
                unit: 'px',
                format: 'letter'
            });

            var canvasElement = document.createElement('canvas');

            html2canvas(this.$refs.content, 
            {
                canvas: canvasElement,
                dpi: 300,
                scale: 1,
                logging: false,
            })
            .then(function (canvas) {
                const img = canvas.toDataURL("image/jpeg");
                doc.addImage(img,'JPEG', 0,0);
                doc.save("sample.pdf");
            });

            // doc.addImage(brand, 'PNG', 10,15, 100, 100);
            // doc.addImage(logo, 'PNG', 220, 175, 100, 100);

            // for(let info of this.infos)
            // {
            //     doc.addPage('letter', 'landscape');
            //     doc.text(110, 110, info.title);
            //     doc.text(110, 120, info.description);
            //     doc.line(30,140,570,140,'s');
            //     doc.text(520, 450, 'Total is 5000');
            // }

            // doc.save("sample.pdf");
        }
    }
}
</script>
