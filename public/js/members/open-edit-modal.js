function openEditModal(id) {
    fetch(`/members/${id}/edit`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to fetch member.");
            }

            return response.json();
        })
        .then((member) => {
            document.getElementById("editMemberForm").action = `/members/${id}`;

            document.getElementById("edit_member_id").value = member.member_id;

            document.getElementById("edit_first_name").value =
                member.first_name;

            document.getElementById("edit_last_name").value = member.last_name;

            document.getElementById("edit_email").value = member.email;

            document.getElementById("edit_phone").value = member.phone ?? "";

            document.getElementById("edit_address").value =
                member.address ?? "";

            document.getElementById("edit_status").value = member.status;

            document
                .getElementById("editMemberModal")
                .classList.remove("hidden");

            document.body.classList.add("overflow-hidden");
        })
        .catch((error) => {
            console.error(error);
            alert("Unable to load member information.");
        });
}
