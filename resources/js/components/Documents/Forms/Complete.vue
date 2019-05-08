<template>
    <div class="col-md-7">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ document.path }}</td>
                    <td>
                        <a :href="'/'+ document.path" download>Download</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default {
        name: 'Complete',
        props: {
            document: {
                type: Object,
            },

        },

    }
</script>