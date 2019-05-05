<template>
    <div class="container">
        <div class="border">
            <div ref="content">
                <div class="d-flex justify-content-between">
                    
                </div>
                <div v-for="product in products" :key="product.id" class="card mb-3">
                    <div class="card-header">
                        <h1>{{ product.product_name }}</h1>
                    </div>
                    <div class="card-body">
                        <h2>{{ product.product_description }}</h2>
                    </div>
                    <div class="card-footer">
                        <small>{{ product.product_cost }}</small>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button @click="createPDF" class="btn btn-success">Generate</button>

        <button @click="pdfPreview" class="btn btn-secondary">Preview</button>
    </div>
</template>

<script>
import * as jsPDF from 'jspdf';
import html2canvas from 'html2canvas';

export default {
    props: ['images', 'products'],
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
            
        },
        pdfPreview()
        {
            const doc = new jsPDF({
                orientation: 'l',
                unit: 'px',
                format: 'letter'
            });

            for(let image of this.images)
            {
                doc.addImage(image.image_base, 'PNG', 10, 15, 100, 100);
            }

            for(let product of this.products)
            {
                doc.addPage('letter', 'landscape');
                doc.text(110, 110, product.product_name);
                doc.text(110, 120, product.product_description);
                doc.line(30, 140, 570, 140, 's');
                doc.text(520, 450, product.product_cost.toString());
            }

            doc.output("dataurlnewwindow", 'sample.pdf');
        }
    }
}
</script>
