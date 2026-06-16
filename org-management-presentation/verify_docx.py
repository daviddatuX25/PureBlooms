from docx import Document

doc = Document('/home/user/Downloads/Pure Blooms/org-management-presentation/PureBlooms_Developed_System_Documentation_with_images.docx')
img_count = 0
for rel in doc.part.rels.values():
    if 'image' in rel.target_ref:
        img_count += 1
print(f'Total images in docx: {img_count}')

# Check for images in paragraphs
for i, p in enumerate(doc.paragraphs):
    for run in p.runs:
        if run._element.xpath('.//w:drawing') or run._element.xpath('.//w:pict'):
            print(f'  Image at paragraph {i}: {(run.text or "(image)")[:80]}')
