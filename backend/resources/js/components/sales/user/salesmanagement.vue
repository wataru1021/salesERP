<template>
    <div class="container">
    <div class="list-group">
        <div class="border border-primary rounded text-center mb-4">
            <a class="list-group-item list-group-item-action" :href="reportRegistrationUrl">
                <h2 class="text-primary mb-0">
                    本日の日報登録
                </h2>
            </a>
        </div>
        <div class="border border-primary rounded text-center mb-4">
            <a class="list-group-item list-group-item-action" :href="checkPastResultsUrl">
                <h2 class="text-primary mb-0">
                    過去の成績を確認する
                </h2>
            </a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["reportRegistrationUrl", "checkPastResultsUrl"],
};
</script>
